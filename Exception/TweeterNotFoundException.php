<?php

namespace Llvdl\TweeterCoreBundle\Exception;

use Llvdl\TweeterCoreBundle\Exception\DomainException;

class TweeterNotFoundException extends DomainException {
    public function __construct($name, $code = 0, $previous = null) {
        parent::__construct('Could not find tweeter with name "'.$name.'"', $code, $previous);
    }
}
