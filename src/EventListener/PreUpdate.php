<?php

namespace App\EventListener;

use App\Entity\Product;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class PreUpdate
{
    public function preUpdate(LifecycleEventArgs $args){
        $entity = $args->getObject();

        if( !$entity instanceof Product )
        {
            return;
        } else {

            die('on est dans le PreUpdate');

        }


    }
}