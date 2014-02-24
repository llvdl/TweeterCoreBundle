<?php

namespace Llvdl\TweeterCoreBundle\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

use Llvdl\TweeterCoreBundle\Entity\Tweet;

class TweetTest extends TestCase {

    use \Llvdl\TweeterCoreBundle\Tests\MockCreator;
    
    /** @var \Llvdl\TweeterCoreBundle\Entity\Tweet */
    private $subject;
    
    private $tweeterMock;
    
    public function setUp() {
        $this->tweeterMock = $this->createTweeterMock();
        $text = 'hello, my tweet';
        $timestamp = 123456;
        $this->subject = new Tweet($this->tweeterMock, $text, $timestamp);
    }
    
    public function testGetters() {
        $this->assertSame(null, $this->subject->getId());
        $this->assertSame($this->tweeterMock, $this->subject->getTweeter());
        $this->assertSame('hello, my tweet', $this->subject->getText());
        $this->assertSame(123456, $this->subject->getTimestamp());
    }
    
    public function testGetIdReturnsPrivateIdProperty() {
        $reflector = new \ReflectionProperty(get_class($this->subject), 'id');
        $reflector->setAccessible(true);
        $reflector->setValue($this->subject, 13);
        
        $this->assertSame(13, $this->subject->getId());
    }
}
