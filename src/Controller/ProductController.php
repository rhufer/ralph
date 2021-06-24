<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Calculator;
use App\Service\TvaSelector;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ProductType;


class ProductController extends AbstractController
{
    private $tvaSelector;
    private $calculator;

    public function __construct(Calculator $calculator, TvaSelector $tvaSelector)
    {
        $this->calculator = $calculator;
        $this->tvaSelector = $tvaSelector;
    }

    public function show(Request $request, $id): Response
    {
        $price = 4.5;
        //$product = $this->getDoctrine()->getRepository(Product::class)->findOneBy($id);
        return $this->render('product/show.html.twig', [
            'slug' => $id,
            'price' => $price,
            'price'  => $this->calculator->calculTva($price),
            'label_price' => $this->tvaSelector->getTauxTva($price),
            //'product' => $product,
            'controller_name' => 'ProductController',
        ]);
    
    }

    public function list(): Response
    {
        
        $products = $this->getDoctrine()->getRepository(Product::class)->findAll();
        dump($products);
        return $this->render('product/list.html.twig', [
            'products' => $products,
            'controller_name' => 'ProductController',
        ]);

        //$products = $this->getDoctrine()->getRepository(ProductRepository::class)->findAll();
        //return $this->render();
    }

    //public function edit(Request $request, Product $product){

    public function edit(Request $request, $id){

       $product = $this->getDoctrine()->getRepository(Product::class)->find($id);

       //$product = $this->getDoctrine()->getRepository(Product::class)->findOneBy(array('id' => $id));
        $this->denyAccessUnlessGranted('ROLE_MANAGER');

        // $form = $this->createFormBuilder()
        //              ->add("name", TextType::class)
        //              ->add("description", TextareaType::class)
        //              ->add("save", SubmitType::class)
        //              ->getForm();

                    //  $form = $this->createFormBuilder()
                    //  ->add("name", ProductType::class)
                    //  ->getForm();                     

        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $product = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();
            die($product->getName());
            return $this->redirectToRoute('task_success');
        }

        return $this->render('product/edit.html.twig',['form' => $form->createView()]);
                                


    }
}
