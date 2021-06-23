<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Service\Slugify;

class CategoryFixtures extends Fixture
{

    private $slugify;
    public function __construct(Slugify $slugify)
    {
        $this->slugify = $slugify;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        for($i = 1; $i < 40; $i++){
            $category = new Category();
            $name = 'category' . $i;
            $category->setName($name);
            $category->setSlug($this->slugify->slugify($name));
            $category->setEnabled(rand(0,1));
            $manager->persist($category);
        }
        $manager->flush();
    }

}
