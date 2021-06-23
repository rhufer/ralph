<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\DataFixtures\CategoryFixtures;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Service\Slugify;
use App\Repository\TypeRepository;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{

    private $slugify;
    private $categoryRepository;
    private $typeRepository;
    public function __construct(Slugify $slugify, CategoryRepository $categoryRepository, TypeRepository $typeRepository)
    {
        $this->slugify = $slugify;
        $this->categoryRepository = $categoryRepository;
        $this->typeRepository = $typeRepository;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $categories = $this->categoryRepository->findAll();
        $type = $this->typeRepository->findAll();

        for($i = 1; $i < 40; $i++){
            $product = new Product();
            $name = 'product' . $i;

            $product->setPrice(rand(3, 50));
            $product->setName($name);
            $product->setCategory($categories[array_rand($categories)]);
            $product->setSlug($this->slugify->slugify($name));
            $product->setDescription('whatever' . $i);
            $product->setProductType($type[array_rand($type)]);

            $manager->persist($product);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [CategoryFixtures::class, TypeFixture::class];
    }
}
