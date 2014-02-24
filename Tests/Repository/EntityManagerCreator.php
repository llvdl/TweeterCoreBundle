<?php

namespace Llvdl\TweeterCoreBundle\Tests\Repository;

trait EntityManagerCreator {

    use \Llvdl\TweeterCoreBundle\Tests\KernelBooter;
    
    private function getEntityManager() {
        $this->bootKernel();
        $entityManager = self::$kernel->getContainer()
                ->get('doctrine')
                ->getManager();
        return $entityManager;
    }

}
