<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\Product;
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
        // $defaultContext = [
        //     AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER = > function ($objct, $format, $connect){
        //         return $object->getId();
        //     }
        // ]

        $normalizer = new ObjectNormalizer();
        $serializer = new Serializer([$normalizer], [$encoder]);

        $jsonContent = $serializer->serialize($cart, 'json');

//        return new
    
    }

}

 