<?php

namespace Llvdl\TweeterCoreBundle\Repository\Impl;

use Llvdl\TweeterCoreBundle\Repository\TweeterRepository;
use Llvdl\TweeterCoreBundle\Entity\Tweeter;
use Doctrine\ORM\EntityManager;
use Llvdl\TweeterCoreBundle\Exception\TweeterExistsException;

class TweeterRepositoryDoctrineImpl implements TweeterRepository {
    
    /** @var EntityManager */
    private $entityManager;
    
    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }
    
    public function add(Tweeter $tweeter) {
        if($this->findByName($tweeter->getName()) !== null) {
            throw new TweeterExistsException($tweeter->getName());
        }
        
        $this->entityManager->persist($tweeter);
        $this->entityManager->flush();
    }

    /** @return Llvdl\TweeterCoreBundle\Entity\Tweeter|NULL tweeter instance or NULL if not found */
    public function findByName($name) {
        $repository = $this->entityManager->getRepository('Llvdl\TweeterCoreBundle\Entity\Tweeter');
        return $repository->findOneByName($name);
    }

}
