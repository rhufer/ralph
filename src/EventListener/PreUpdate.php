<?php

namespace App\EventListener;

use App\Entity\Product;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Psr\Log\LoggerInterface;

class PreUpdate
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function preUpdate(LifecycleEventArgs $args){
        $entity = $args->getObject();

        if( !$entity instanceof Product )
        {
            return;
        } else {
            $this->logger->alert('on est dans le PreUpdate');
            $this->logger->error('on est dans le PreUpdate');
            //die('on est dans le PreUpdate');

        }


    }
}