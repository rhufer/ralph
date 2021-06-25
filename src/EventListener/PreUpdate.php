<?php

namespace App\EventListener;

use App\Entity\Product;
use Doctrine\ORM\Event\PreUpdateEventArgs;
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

            $entityManager = $args->getObjectManager();            

        }
        
    }

    protected function slugify(PreUpdateEventArgs $args){

            $entity = $args->getEntity();
            
            foreach($entity->getSluggableFields() as $field){
                if (method_exists($args, 'getEntityChangeSet'))
                    if (!array_key_exists($field, $args->getEntityChangeSet()))
                        continue;
            }
    }
}