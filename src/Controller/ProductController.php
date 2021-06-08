<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use DateTime;
use Symfony\Component\Filesystem\Filesystem;

class ProductController extends AbstractController
{
    /**
     * @Route("roleuser/downloadpdf", name="roleuser_downloadpdf")
     */
    public function index(ProductRepository $ProductRepository): Response
    {
        $products = $ProductRepository->findAll();
        return $this->render('roleuser/downloadpdf.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * @Route("/product/new", name="app_product_new")
     */
    public function new(ProductRepository $ProductRepository, Request $request, SluggerInterface $slugger)
    {
        $products = $ProductRepository->findAll();
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $brochureFile */
            $product->setCreatedAt(new DateTime());
            $brochureFile = $form->get('brochure')->getData();
            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $brochureFile->move(
                        $this->getParameter('brochures_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                $product->setBrochureFilename($newFilename);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();
            return $this->redirectToRoute('app_product_new');
        }
        return $this->render('product/new.html.twig', [
            'products' => $products,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("product/delete/{id}", name="product_delete", methods={"GET","POST"})
     */
    public function delete(Request $request, Product $product, $id): Response
    {
        $filesystem = new Filesystem();
        $filename= $product->getBrochureFilename();
        unlink($this->getParameter('brochures_directory').'/'.$filename);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($product);
            $entityManager->flush();
           // dd($path);
        return $this->redirectToRoute('app_product_new');
    }

}
