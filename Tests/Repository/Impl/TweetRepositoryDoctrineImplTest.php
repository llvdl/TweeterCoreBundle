<?php

namespace Llvdl\TweeterCoreBundle\Tests\Repository\Impl;

use Llvdl\TweeterCoreBundle\Repository\Impl\TweetRepositoryDoctrineImpl;
use Liip\FunctionalTestBundle\Test\WebTestCase;

use Llvdl\TweeterCoreBundle\Entity\Tweet;

class TweetRepositoryDoctrineImplTest extends WebTestCase {

    use \Llvdl\TweeterCoreBundle\Tests\Repository\EntityManagerCreator;
    
    /** @var \Doctrine\ORM\EntityManager */
    private $entityManager;
    
    /** @var TweetRepositoryDoctrineImpl */
    private $subject;
    
    public function setUp() {
        $this->entityManager = $this->getEntityManager();
        $client = static::createClient();
        $this->loadFixtures([
            '\Llvdl\TweeterCoreBundle\Tests\DataFixtures\Orm\LoadTweetData',
            '\Llvdl\TweeterCoreBundle\Tests\DataFixtures\Orm\LoadTweeterData',
        ]);

        $this->subject = new TweetRepositoryDoctrineImpl($this->entityManager);
    }
    
    public function testImplementsInterface() {
        $this->assertInstanceOf('Llvdl\TweeterCoreBundle\Repository\TweetRepository', $this->subject);
    }
    
    public function testFindByTweeterNoTweets() {
        $tweeterNoTweets = $this->loadTweeterByName('tweeter no tweets');
        $this->assertSame([], $this->subject->FindByTweeter($tweeterNoTweets));
    }

    public function testFindByTweeterOneTweet() {
        $tweeterOneTweet = $this->loadTweeterByName('tweeter one tweet');
        $tweets = $this->subject->FindByTweeter($tweeterOneTweet);
        $this->assertCount(1, $tweets);
    }

    public function testFindByTweeterManyTweetsReturnsOrderedByMostRecentFirst() {
        $tweeterManyTweets = $this->loadTweeterByName('tweeter many tweets');
        $tweets = $this->subject->FindByTweeter($tweeterManyTweets);
        $this->assertCount(3, $tweets);
        $this->assertSame('my third tweet', $tweets[0]->getText());
        $this->assertSame('my second tweet', $tweets[1]->getText());
        $this->assertSame('my first tweet', $tweets[2]->getText());
    }
    
    public function testAddTweet() {
        $tweeterManyTweets = $this->loadTweeterByName('tweeter many tweets');
        $tweet = new Tweet($tweeterManyTweets, 'hello a tweet', time());
        
        $this->subject->add($tweet);
        $this->assertNotNull($tweet->getId(), 'after persisting an id is assigned to the object');
        
        $loadedTweet = $this->loadTweetById($tweet->getId());
        $this->assertNotNull($loadedTweet, 'tweet is persisted and can be loaded');
        $this->assertSame('hello a tweet', $loadedTweet->getText());
    }
    
    public function testFindMostRecentOne() {
        $tweets = $this->subject->findMostRecent(1);
        $this->assertCount(1, $tweets);
        $this->assertSame('my third tweet', $tweets[0]->getText());
    }

    public function testFindMostRecentReturnAll() {
        $tweets = $this->subject->findMostRecent(4);
        $this->assertCount(4, $tweets);
        $this->assertSame('my third tweet', $tweets[0]->getText());
        $this->assertSame('my second tweet', $tweets[1]->getText());
        $this->assertSame('a text', $tweets[2]->getText());
        $this->assertSame('my first tweet', $tweets[3]->getText());
    }
    
    public function testFindMostRecentMaxMoreThanAvailableReturnsOnlyAvailable() {
        $tweets = $this->subject->findMostRecent(10);
        $this->assertCount(4, $tweets);
        $this->assertSame('my third tweet', $tweets[0]->getText());
        $this->assertSame('my second tweet', $tweets[1]->getText());
        $this->assertSame('a text', $tweets[2]->getText());
        $this->assertSame('my first tweet', $tweets[3]->getText());
    }

    private function loadTweeterByName($name) {
        $repository = $this->entityManager->getRepository('Llvdl\TweeterCoreBundle\Entity\Tweeter');
        $tweeter = $repository->findOneByName($name);
        if($tweeter === null) {
            throw new \Exception('could not find tweeter with name "'.$name.'"');
        }
        return $tweeter;
    }
    
    private function loadTweetById($id) {
        $repository = $this->entityManager->getRepository('Llvdl\TweeterCoreBundle\Entity\Tweet');
        return $repository->find($id);
    }
    
}
