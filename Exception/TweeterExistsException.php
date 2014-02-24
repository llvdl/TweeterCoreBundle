<?php

namespace Llvdl\TweeterCoreBundle\Exception;

use Llvdl\TweeterCoreBundle\Exception\DomainException;

class TweeterExistsException extends DomainException {
    public function __construct($name, $code = 0, $previous = null) {
        parent::__construct('Tweeter with name "'.$name.'" already exists', $code, $previous);
    }
}
