<?php

namespace Llvdl\TweeterCoreBundle\Service;

use Llvdl\TweeterCoreBundle\Repository\TweetRepository;
use Llvdl\TweeterCoreBundle\Repository\TweeterRepository;
use Llvdl\TweeterCoreBundle\Exception\TweeterNotFoundException;

use Llvdl\TweeterCoreBundle\Entity\Tweet;
use Llvdl\TweeterCoreBundle\Entity\Tweeter;


class TweetService {

    /** @var \Llvdl\TweeterCoreBundle\Entity\TweetRepository */
    private $tweetRepository;
    /** @var \Llvdl\TweeterCoreBundle\Entity\TweeterRepository */
    private $tweeterRepository;
    
    public function __construct(TweetRepository $tweetRepository, TweeterRepository $tweeterRepository) {
        $this->tweetRepository = $tweetRepository;
        $this->tweeterRepository = $tweeterRepository;
    }
    
    /** @return \Llvdl\TweeterCoreBundle\Entity\Tweet[] */
    public function getRecentTweets() {
        return $this->tweetRepository->findMostRecent(10);
    }
    
    /** 
     * @param string $name
     * @return Tweet[]
     * @throws TweeterNotFoundException if tweeter is not found
     */
    public function getRecentTweetsForTweeter($name) {
        $tweeter = $this->getTweeterByName($name);
        if($tweeter === null) {
            throw new TweeterNotFoundException($name);
        }
        return $this->tweetRepository->findByTweeter($tweeter);
    }
    
    /**
     * @param string $name tweeter name
     * @param string $text
     * @return Tweet
     */
    public function createTweet($name, $text) {
        $timestamp = time();
        
        $tweeter = $this->findOrCreateTweeterByName($name);
        $tweet = new Tweet($tweeter, $text, $timestamp);
        $this->tweetRepository->add($tweet);
        return $tweet;
    }
    
    /** @return Tweeter */
    private function findOrCreateTweeterByName($name) {
        $tweeter = $this->getTweeterByName($name);
        if($tweeter === null) {
            $tweeter = $this->createTweeter($name);
        }
        return $tweeter;
    }
    
    /** @return Tweeter|NULL */
    private function getTweeterByName($name) {
        $tweeter = $this->tweeterRepository->findByName($name);
        return $tweeter;
    }
    
    /** @return Tweeter */
    private function createTweeter($name) {
        $tweeter = new Tweeter($name);
        $this->tweeterRepository->add($tweeter);
        return $tweeter;
    }
}
