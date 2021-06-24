<?php

namespace App\ParamConverter;

use App\Repository\ProductRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;

class ProductConverter implements ParamConverterInterface{

    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function apply(Request $request, ParamConverter $configuration)
    {

        $product = $this->productRepository->findOneBy(['slug' => $request->get('slug')]);
        die($product);
        $request->attributes->set($configuration->getName(),$product);
    }

    public function supports(ParamConverter $configuration)
    {
        
    }
}
