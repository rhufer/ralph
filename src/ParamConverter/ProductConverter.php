<?php

namespace App\ParamConverter;

use App\Repository\ProductRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;

class ProductConverter implements ParamConverterInterface{

    private $productRepository;

    public function __construct(ProductRepository $productRepositoryt)
    {
        //$this->logger = $logger;
    }

    public function apply(Request $request, ParamConverter $configurtion)
    {
        //$product = $this->productRepository->find
    }

    public function supports(ParamConverter $configuration)
    {
        
    }
}
