<?php

namespace App\Controller;

use App\Entity\Payment;
use App\Form\PaymentType;
use App\Form\SearchFormBetweenDateType;
use App\Repository\PaymentRepository;
use App\Repository\PaymentstockRepository;
use App\Repository\PaymentstocksRepository;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
/**
 * @Route("/payment")
 */
class PaymentController extends AbstractController
{
    /**
     * @Route("/", name="payment_index", methods={"GET","POST"})
     */
    public function index(PaymentRepository $paymentRepository , PaginatorInterface $paginator, Request $request): Response
    {
        $payment = $paymentRepository->findBy(['status' => true], ['createdAt' => 'desc']);
        $payments = $paginator->paginate(($payment),
        $request->query->getInt('page', 1),
        6
        );
        return $this->render('payment/index.html.twig', [
            'payments' => $payments,
        ]);
    }

        /**
     * @Route("/fromto", name="payment_from_to", methods={"GET","POST"})
     */
    public function fromto(PaymentRepository $paymentRepository , PaginatorInterface $paginator, Request $request): Response
    {
        $payments = $paymentRepository->findAllfromto();
        // $payments = $paginator->paginate(($payment),
        // $request->query->getInt('page', 1),
        // 8
        // );
        $form = $this->createForm(SearchFormBetweenDateType::class);
        $search = $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $payments = $paymentRepository->getByDate(
                $search->get('from')->getData(),
                $search->get('to')->getData(),
                $search->get('mots')->getData()
            );
         
        }
        return $this->render('payment/fromto.html.twig', [
            'payments' => $payments,
            'searchForm' => $form->createView()
        ]);
    }

    /**
     * @Route("payment/data/", name="payment_data", methods={"GET", "POST"})
     */
    public function data(PaymentstockRepository $paymentstockRepository, Request $request): Response
    {
        $paymentstocks = $paymentstockRepository->findAll();
        return $this->render('payment/data.html.twig', [
            'paymentstocks' => $paymentstocks,      
        ]);
    } 

            /**
     * @Route("/payment/data/download/", name="payment_data_download", methods={"GET", "POST"})
     */
    public function invoiceDataDownload(PaymentstockRepository $paymentstockRepository)
    {
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($pdfOptions);
        $paymentstocks = $paymentstockRepository->findAll();
        $html= $this->renderView('payment/download.html.twig',[
            'paymentstocks' => $paymentstocks, 
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
     * @Route("/new", name="payment_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $payment = new Payment();
        $form = $this->createForm(PaymentType::class, $payment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $payment->setStatus(true);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($payment);
            $entityManager->flush();

            return $this->redirectToRoute('payment_index');
        }

        return $this->render('payment/new.html.twig', [
            'payment' => $payment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="payment_show", methods={"GET"})
     */
    public function show(Payment $payment): Response
    {
        return $this->render('payment/show.html.twig', [
            'payment' => $payment,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="payment_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Payment $payment): Response
    {
        $form = $this->createForm(PaymentType::class, $payment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('payment_index');
        }

        return $this->render('payment/edit.html.twig', [
            'payment' => $payment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="payment_delete", methods={"POST"})
     */
    public function delete(Request $request, Payment $payment): Response
    {
        if ($this->isCsrfTokenValid('delete'.$payment->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($payment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('payment_index');
    }
}
