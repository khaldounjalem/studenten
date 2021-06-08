<?php

namespace App\Controller;

use App\Form\ContactType;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    
    /**
     * @Route("/contact", name="contact")
     */

    public function index(Request $request, \Swift_Mailer $mailer): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
      // $this->addFlash('info', 'Some info');
        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();
           // dump($contact);
            // Ici nous enverrons l'e-mail
            $message = (new \Swift_Message('You Got Mail!'))
            // On attribue l'expéditeur
            ->setFrom($contact['email'])
        
            // On attribue le destinataire
            ->setTo('kokomic@gmail.com.com')
        
            // On crée le texte avec la vue
            ->setBody(
                $contact['message'],
                'text/plain'
            )
        ;
            $mailer->send($message);
        
            $this->addFlash('success', 'we have received your message and will answer as soon as possible.');
            
           return $this->redirectToRoute("contact");
        }
        return $this->render('contact/index.html.twig',[
            'contactForm' => $form->createView()
            ]);
    }
    
}
