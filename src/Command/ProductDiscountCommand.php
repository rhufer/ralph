<?php

namespace App\Command;

use App\Repository\CategoryRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Input\InputArgument;

Class ProductDiscountCommand extends Command{

    protected static $defaultName = 'app:product-discount-command';

    private $productRepository;
    private $categoryRepository;
    private $entityManager;
    
    public function __construct(EntityManagerInterface $entityManager, ProductRepository $productRepository, CategoryRepository $categoryRepository)  
    {
        parent::__construct();
        $this->entityManager = $entityManager;
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }
    
    protected function configure()
    {
        $this->setDescription('Modification du prix des produits');

        $this->addArgument('rate',InputArgument::REQUIRED, 'Le taux du prix');
        $this->addArgument('categorie',InputArgument::OPTIONAL, 'La catégorie du produit');
    }
    
    protected function execute(InputInterface $input, OutputInterface $output){
    
    $output->writeln("debut commande");
    $products = $this->productRepository->findAll();
    $categorie = $this->categoryRepository->findOneBy(array('slug'=> $input->getArgument('categorie')));
    $output->writeln($categorie->getId());
    $taux=$input->getArgument('rate');
    
    if (is_null($input->getArgument('categorie'))){
        $output->writeln("categorie vide");
        $slug = "category6";
    } else {
        $slug = $input->getArgument('categorie');
    }

    foreach($products as $product){
        if ($product->getCategory()->getSlug() === $slug){
        $product->setPrice($product->getPrice()*$taux);
        $em=$this->entityManager;
        $em->persist($product);
    }

        $output->writeln("produit = " . $product->getName());
    }
    $em->flush();

    $output->writeln("fin commande");
    
    return Command::SUCCESS;
    
    }
}
    