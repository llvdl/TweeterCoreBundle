<?php

namespace Llvdl\TweeterCoreBundle\Entity;

class Tweeter {

    /** @var int */
    private $id;
    /** @var string */
    private $name;
    
    public function __construct($name) {
        $this->id = null;
        $this->name = $name;
    }
    
    /** @return int */
    public function getId() {
        return $this->id;
    }

    /** @return string */
    public function getName() {
        return $this->name;
    }
}
