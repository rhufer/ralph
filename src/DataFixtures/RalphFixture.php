<?php

namespace App\DataFixtures;

use App\Entity\Ralph;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RalphFixture extends Fixture
{
    private $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager)
    {
        foreach(['ROLE_ADMIN','ROLE_MANAGER','ROLE_USER'] as $role ){
            $user = new Ralph();
            //$user->setEmail(str_replace("role_","",strtolower($role))."@formation.com");
            $user->setUsername("ralph"."_".strtolower($role));
            $user->setRoles([$role]);

            //sdd($this->hasher);
            $user->setPassword($this->hasher->hashPassword($user,'password'));
            $manager->persist($user);
        }


        // $user3 = new Ralph();
        // $user3->setRoles(array("ROLE_MANAGER"));
        // $username = 'manager1';
        // $user3->setUsername('manager1');
        // $password = 'manager1';
        // $user3->setPassword('manager1');
        // $user3->setPassword($this->userPasswordHasher->hashPassword($user3, $password));

        //$manager->persist($user3);

        $manager->flush();
    }
}
