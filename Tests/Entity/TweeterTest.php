<?php

namespace Llvdl\TweeterCoreBundle\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

use Llvdl\TweeterCoreBundle\Entity\Tweeter;

class TweeterTest extends TestCase {

    use \Llvdl\TweeterCoreBundle\Tests\MockCreator;
    
    private $subject;
    
    public function setUp() {
        $this->subject = new Tweeter('my name');
    }
    
    public function testGetters() {
        $this->assertSame(null, $this->subject->getId());
        $this->assertSame('my name', $this->subject->getName());
    }
    
    public function testGetIdReturnsPrivateIdProperty() {
        $reflector = new \ReflectionProperty(get_class($this->subject), 'id');
        $reflector->setAccessible(true);
        $reflector->setValue($this->subject, 13);
        
        $this->assertSame(13, $this->subject->getId());
    }
    
}
