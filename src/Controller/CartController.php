<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Calculator;
use App\Service\TvaSelector;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use App\Form\CategoryType;

class CartController extends AbstractController
{

    private $user;

    public function __construct(TokenStorageInterface $token_storage)
    {
        $this->user = $token_storage->getToken()->getUser();
    }

    public function add(Request $request, $id): Response
    {
       // die('Oui');
        
        $product = $this->getDoctrine()->getRepository(Product::class)->findOneBy(array('id' => $id));
        //die($product->getName());
        //die ('Identifiant du produit = ' . $id . ',  user = ' . $this->user->getUserIdentifier() . ', produit = ' . $product->getName());
        $cart = new Cart();

        $cart->setUser($this->user);
        $cart->addProduct($product);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($cart);
        $entityManager->flush();

        return $this->render('product/cart.html.twig', [
            'controller_name' => 'CartController',
        ]);

        $encoder = new JsonEncoder();
        $defaultContext = [
             AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($objct, $format, $connect){
                 return $object->getId();
             }
            ];

        $normalizer = new ObjectNormalizer();
        $serializer = new Serializer([$normalizer], [$encoder]);

        $jsonContent = $serializer->serialize($cart, 'json');

    }


    public function editCat(Request $request, Category $category){

         $this->denyAccessUnlessGranted('ROLE_MANAGER');
 
         $form = $this->createForm(CategoryType::class, $category);
 
         $form->handleRequest($request);
         if ($form->isSubmitted() && $form->isValid()) {
             // $form->getData() holds the submitted values
             // but, the original `$task` variable has also been updated
             $category = $form->getData();
 
             // ... perform some action, such as saving the task to the database
             // for example, if Task is a Doctrine entity, save it!
             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($category);
             $entityManager->flush();
         }
 
         return $this->render('product/edit.html.twig',['form' => $form->createView()]);
 
 
 
     }

}

 