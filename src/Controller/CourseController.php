<?php

namespace App\Controller;

use App\Entity\Course;
use App\Form\CourseType;
use App\Form\SearchFormType;
use App\Repository\CourseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Dompdf\Dompdf;
use Dompdf\Options;

/**
 * @Route("/course")
 */
class CourseController extends AbstractController
{
    /**
     * @Route("/", name="course_index", methods={"GET","POST"})
     */
    public function index(CourseRepository $courseRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $courses = $courseRepository->findBy(['status' => true], ['createdAt' => 'desc']);
        // $courses = $paginator->paginate(($course),
        // $request->query->getInt('page', 1),
        // 2
        // );

        $form = $this->createForm(SearchFormType::class);
        $search = $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            // On recherche les annonces correspondant aux mots clés
            $courses = $courseRepository->searchCourse(
                $search->get('mots')->getData()
         //       $search->get('categorie')->getData()
            );
        }
        
        return $this->render('course/index.html.twig', [
            'courses' => $courses,
            'searchForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/searchcourse", name="course_searchcourse", methods={"GET","POST"})
     */
    public function searchcourse(CourseRepository $courseRepository, Request $request): Response
    {
       $courses = $courseRepository->findBy(['status' => true], ['createdAt' => 'desc'], 5);
       $resultcourses =$courseRepository->findAllsearchCourse();       
        $form = $this->createForm(SearchFormType::class);
        
        $search = $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            // On recherche les annonces correspondant aux mots clés
            $courses = $courseRepository->searchCourse(
                $search->get('mots')->getData()
         //       $search->get('categorie')->getData()
            );
        }
        return $this->render('course/searchcourse.html.twig', [
            'courses' => $courses,
            'resultcourses' => $resultcourses, 
            'searchForm' => $form->createView()
        ]);
    } 

        /**
     * @Route("course/data/{id}", name="course_data", methods={"GET", "POST"})
     */
    public function data(CourseRepository $courseRepository, Request $request, $id): Response
    {
       $courses = $courseRepository->findAllsearchCoursedata($id);
       // dd($courses);
       $resultcourses =$courseRepository->findAllsearchCourse();       
        return $this->render('course/data.html.twig', [
            'courses' => $courses,
            'resultcourses' => $resultcourses, 
        ]);
    } 

            /**
     * @Route("/course/data/download/{id}", name="course_data_download", methods={"GET", "POST"})
     */
    public function invoiceDataDownload(CourseRepository $courseRepository, $id)
    {
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($pdfOptions);
        $courses = $courseRepository->findAllsearchCoursedata($id);
        // dd($courses);
        $resultcourses =$courseRepository->findAllsearchCourse(); 
         //  $invoiceDetaill = new InvoiceDetaill();
           $html= $this->renderView('course/download.html.twig',[
            'courses' => $courses,
           'resultcourses' => $resultcourses,
        ]);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        ob_clean();
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => true
        ]);
        ob_flush();
    return new Response();
}

    /**
     * @Route("/new", name="course_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $course = new Course();
        $form = $this->createForm(CourseType::class, $course);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $course->setStatus(true);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($course);
            $entityManager->flush();

            return $this->redirectToRoute('course_index');
        }

        return $this->render('course/new.html.twig', [
            'course' => $course,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="course_show", methods={"GET"})
     */
    public function show(Course $course): Response
    {
        return $this->render('course/show.html.twig', [
            'course' => $course,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="course_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Course $course): Response
    {
        $form = $this->createForm(CourseType::class, $course);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('course_index');
        }

        return $this->render('course/edit.html.twig', [
            'course' => $course,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="course_delete", methods={"POST"})
     */
    public function delete(Request $request, Course $course): Response
    {
        if ($this->isCsrfTokenValid('delete'.$course->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($course);
            $entityManager->flush();
        }

        return $this->redirectToRoute('course_index');
    }


}
