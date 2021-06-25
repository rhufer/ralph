<?php

namespace App\EventListener;

use App\Entity\Product;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Psr\Log\LoggerInterface;

class PrePersist
{

    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function prePersist(LifecycleEventArgs $args){
        $entity = $args->getObject();

        if( !$entity instanceof Product )
        {
            return;
        } else {
            $this->logger->alert('on est dans le PrePersist');
            $this->logger->error('on est dans le PrePersist');
            //die('on est dans le PrePersist');
            $entityManager = $args->getObjectManager();

        }

    }
}