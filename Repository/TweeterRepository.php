<?php

namespace Llvdl\TweeterCoreBundle\Repository;

use Llvdl\TweeterCoreBundle\Entity\Tweeter;

interface TweeterRepository {
    
    /**
     * finds a tweeter by name
     * @param string $name name
     * @return Llvdl\Tweetr\Domain\Tweeter|NULL tweeter if found, otherwise NULL
     */
    public function findByName($name);
    
    /**
     * adds a tweeter to the repository
     * @param Llvdl\Tweetr\Domain\Tweeter $tweeter
     */
    public function add(Tweeter $tweeter);
    
}
