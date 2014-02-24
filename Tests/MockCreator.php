<?php

namespace Llvdl\TweeterCoreBundle\Tests;

trait MockCreator {
    
    private function createTweetRepositoryMock() {
        return $this->createMock('Llvdl\TweeterCoreBundle\Repository\TweetRepository');
    }
    
    private function createTweeterRepositoryMock() {
        return $this->createMock('Llvdl\TweeterCoreBundle\Repository\TweeterRepository');
    }
    
    private function createTweetMock() {
        return $this->createMock('Llvdl\TweeterCoreBundle\Entity\Tweet');
    }

    private function createTweeterMock($id = null, $name = '') {
        $mock = $this->createMock('Llvdl\TweeterCoreBundle\Entity\Tweeter');
        $mock->expects($this->any())->method('getId')->with()->will($this->returnValue($id));
        $mock->expects($this->any())->method('getName')->with()->will($this->returnValue($name));
        return $mock;
    }

    private function createMock($className) {
        return $this->getMock($className, [], [], '', false);
    }
}
