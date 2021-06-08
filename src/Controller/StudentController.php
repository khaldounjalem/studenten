<?php

namespace App\Controller;

use App\Entity\Student;
use App\Entity\Studentdetaill;
use App\Form\SearchFormType;
use App\Form\StudentdetaillType;
use App\Form\StudentType;
use App\Repository\CourseRepository;
use App\Repository\PaymentRepository;
use App\Repository\StudentdetaillRepository;
use App\Repository\StudentRepository;
use DateTime;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
//use Knp\Component\Pager\PaginatorInterface;
// use Knp\Bundle\PaginatorBundle\Pagination\SlidingPaginationInterface;


class StudentController extends AbstractController
{
    /**
     * @Route("student/", name="student_index", methods={"GET","POST"})
     */
    public function index(StudentRepository $studentRepository, PaginatorInterface $paginator, Request $request): Response
    {
       $students = $studentRepository->findBy(['status' => true], ['createdAt' => 'desc']);

        //  $students = $paginator->paginate(($student),
        //  $request->query->getInt('page', 1),
        //  3
        //  );
   
        $form = $this->createForm(SearchFormType::class);
        
        $search = $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            // On recherche les annonces correspondant aux mots clés
            $students = $studentRepository->search(
                $search->get('mots')->getData()
         //       $search->get('categorie')->getData()
            );
        }
        return $this->render('student/index.html.twig', [
            'students' => $students,
            'searchForm' => $form->createView()
        ]);
    }

    /**
     * @Route("roleuser/searchresult", name="roleuser_searchresult", methods={"GET","POST"})
     */
    public function searchresult(StudentRepository $studentRepository, Request $request): Response
    {
       $students = $studentRepository->findAll();
       $resultstudents =$studentRepository->findAllresult();
        $form = $this->createForm(SearchFormType::class);
        
        $search = $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            // On recherche les annonces correspondant aux mots clés
            $students = $studentRepository->searchResult(
                $search->get('mots')->getData()
         //       $search->get('categorie')->getData()
            );
        }
        return $this->render('roleuser/searchresult.html.twig', [
            'students' => $students,
            'resultstudents' => $resultstudents,            
            'searchForm' => $form->createView()
        ]);
    }    



    /**
     * @Route("student/new", name="student_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $student = new Student();
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $student->setStatus(true);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($student);
            $entityManager->flush();

            return $this->redirectToRoute('student_index');
        }

        return $this->render('student/new.html.twig', [
            'student' => $student,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("student/{id}", name="student_showwithdetaill", methods={"GET","POST"})
     */
    public function showwithdetaill(Student $student,StudentRepository $studentRepository,PaymentRepository $paymentRepository, Request $request,  $id): Response
    {
       // $payments = $paymentRepository->findAll();
        $resultpayments =$studentRepository->findAllPayment($id);
        $resulttotalpayments =$studentRepository->findAllTotalPayment($id);
        $resultTotals =$studentRepository->findAllTotalPreis($id);
        $result =$studentRepository->findAllCourse($id);
        $studentdetaill = new Studentdetaill();
        $form = $this->createForm(StudentdetaillType::class, $studentdetaill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $studentdetaill->setStudent($student);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($studentdetaill);
            $entityManager->flush();

            return $this->redirectToRoute("student_showwithdetaill", ['id' => $student->getId()]);
        }
        
        return $this->render('student/showwithdetaill.html.twig', [
            'resultpayments' => $resultpayments,
            'resulttotalpayments' => $resulttotalpayments,
            'student' => $student,
            'result' => $result,
            'resultTotals' => $resultTotals,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("student/{id}", name="student_show", methods={"GET"})
     */
    public function show(Student $student): Response
    {
        return $this->render('student/show.html.twig', [
            'student' => $student,
        ]);
    }



    /**
     * @Route("student/{id}/edit", name="student_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Student $student): Response
    {
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('student_index');
        }

        return $this->render('student/edit.html.twig', [
            'student' => $student,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("student/{id}", name="student_delete", methods={"POST"})
     */
    public function delete(Request $request, Student $student): Response
    {
        if ($this->isCsrfTokenValid('delete'.$student->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($student);
            $entityManager->flush();
        }
        return $this->redirectToRoute('student_index');
    }

}
