<?php

namespace Llvdl\TweeterCoreBundle\Tests\DataFixtures\Orm;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Llvdl\TweeterCoreBundle\Entity\Tweet;

class LoadTweetData extends AbstractFixture implements OrderedFixtureInterface {
    
    public function getOrder() {
        return 2;
    }

    public function load(ObjectManager $manager) {
        $tweeter1 = $this->getReference('tweeter-1-many-tweets');
        $tweeter2 = $this->getReference('tweeter-2-one-tweet');
        
        $tweet1 = new Tweet($tweeter1, 'my first tweet', 123450);
        $tweet2 = new Tweet($tweeter1, 'my second tweet', 123457);
        $tweet3 = new Tweet($tweeter1, 'my third tweet', 123458);
        $tweet4 = new Tweet($tweeter2, 'a text', 123456);

        $manager->persist($tweet1);
        $manager->persist($tweet2);
        $manager->persist($tweet3);
        $manager->persist($tweet4);
        $manager->flush();
        
        $this->addReference('tweet-1-1', $tweet1);
        $this->addReference('tweet-1-2', $tweet2);
        $this->addReference('tweet-1-3', $tweet3);
        $this->addReference('tweet-2-1', $tweet4);
    }

}
