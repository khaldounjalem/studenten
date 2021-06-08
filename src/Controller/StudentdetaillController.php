<?php

namespace App\Controller;

use App\Entity\Student;
use App\Entity\Studentdetaill;
use App\Form\StudentdetaillType;
use App\Repository\StudentdetaillRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/studentdetaill")
 */
class StudentdetaillController extends AbstractController
{


    /**
     * @Route("/new", name="studentdetaill_new", methods={"GET","POST"})
     */
    public function new(Request $request,StudentdetaillRepository $studentdetaillRepository): Response
    {
        $studentdetaills = $studentdetaillRepository->findAll();
        $studentdetaill = new Studentdetaill();
        $form = $this->createForm(StudentdetaillType::class, $studentdetaill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($studentdetaill);
            $entityManager->flush();

            return $this->redirectToRoute('studentdetaill_index');
        }

        return $this->render('studentdetaill/new.html.twig', [
            'studentdetaills' => $studentdetaills,
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/{id}/edit", name="studentdetaill_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Studentdetaill $studentdetaill): Response
    {   
        $data = json_decode($request->getContent(), true);

        $form = $this->createForm(StudentdetaillType::class, $studentdetaill);
        $form->handleRequest($request);
      //  if($this->isCsrfTokenValid('edit'.$studentdetaill->getId(), $data['_token'])){
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
        //dd($studentid);
     //   return $this->redirectToRoute("student_showwithdetaill", ['id' => $data['_token']]);
     //   }
    }
        return $this->render('studentdetaill/edit.html.twig', [
            'studentdetaill' => $studentdetaill,
            'form' => $form->createView(),
        ]);
    }

  


/**
 * @Route("/delete/{id}", name="studentdetaill_delete", methods={"DELETE"})
 */
public function deleteImage(Studentdetaill $studentdetaill, Request $request){
    $data = json_decode($request->getContent(), true);

    // On vérifie si le token est valide
    if($this->isCsrfTokenValid('delete'.$studentdetaill->getId(), $data['_token'])){
        // On supprime l'entrée de la base
        $em = $this->getDoctrine()->getManager();
        $em->remove($studentdetaill);
        $em->flush();

        // On répond en json
        return new JsonResponse(['success' => 1]);
    }else{
        return new JsonResponse(['error' => 'Token Invalide'], 400);
    }
}

}
