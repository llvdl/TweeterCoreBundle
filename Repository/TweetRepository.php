<?php

namespace Llvdl\TweeterCoreBundle\Repository;

use Llvdl\TweeterCoreBundle\Entity\Tweeter;
use Llvdl\TweeterCoreBundle\Entity\Tweet;

interface TweetRepository {
    
    /**
     * find the $maxAmount most recent tweets
     * @param int $maxAmount maximum amount of tweets in the result set
     * @return Llvdl\Tweetr\Domain\Tweet[] list of tweeters, sorted by most recent first
     */
    public function findMostRecent($maxAmount);
    
    /**
     * finds all tweets made by a specific tweeter
     * @param Llvdl\Tweetr\Domain\Tweeter $tweeter
     * @return Llvdl\Tweetr\Domain\Tweet[] list of tweeters, sorted by most recent first
     */
    public function FindByTweeter(Tweeter $tweeter);
    
    /**
     * adds a tweet to the repository
     * @param Llvdl\Tweetr\Domain\Tweet $tweet
     */
    public function add(Tweet $tweet);
}
