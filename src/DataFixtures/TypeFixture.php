<?php

namespace App\DataFixtures;

use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TypeFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $product_type = new Type();
        $product_type->setName('type1');
        $product_type->setLabel('label1');
        $product_type->setRate('10');

        $manager->persist($product_type);
        $manager->flush();
        
    }

}
