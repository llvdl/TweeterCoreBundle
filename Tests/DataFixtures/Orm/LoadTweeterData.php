<?php

namespace Llvdl\TweeterCoreBundle\Tests\DataFixtures\Orm;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Llvdl\TweeterCoreBundle\Entity\Tweeter;

class LoadTweeterData extends AbstractFixture implements OrderedFixtureInterface {
    
    public function getOrder() {
        return 1;
    }

    public function load(ObjectManager $manager) {
        $tweeters = $this->createTweeters();
        $this->persist($manager, $tweeters);
        $this->addReferences($tweeters);
    }
    
    private function createTweeters() {
        return [
            'tweeter-1-many-tweets' => new Tweeter('tweeter many tweets'),
            'tweeter-2-one-tweet' => new Tweeter('tweeter one tweet'),
            'tweeter-3-no-tweets' => new Tweeter('tweeter no tweets'),
        ];
    }
     
    private function persist(ObjectManager $manager, array $tweeters) {
        foreach($tweeters as $tweeter) {
            $manager->persist($tweeter);
        }
        $manager->flush();
    }
    
    private function addReferences(array $tweeters) {
        foreach($tweeters as $key=>$tweeter) {
            $this->addReference($key, $tweeter);
        }
    }

}
