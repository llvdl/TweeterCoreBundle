Llvdl Tweeter Core Bundle
=========================

This is a sample Symfony2 bundle that contains a simple service store and 
retrieve "tweets". The bundle consists of a service implementation, including a 
repository based on doctrine. It has no forms or controllers.


Installing
----------

Add the following line to the `require` section in your composer.json file:

`"llvdl/example-tweeter-core-bundle": "dev-master"`

and run composer update.

Add the following item to the `$bundles` array in `registerBundles` in 
AppKernel.php:

`new Llvdl\TweeterCoreBundle\TweeterCoreBundle()`


Initiating the database
-----------------------

You should have the doctrine/orm package installed. Also a 
database and user must be created. The configuration of the database properties
is probably at `app/config/parameters.yml`.

To create the database tables, run:

`php app/console doctrine:schema:create`

To see the SQL queries to create the tables, but not execute them, add the
`--dump-sql` flag:

`php app/console doctrine:schema:create --dump-sql`


Using the service
-----------------

The bundle gives access to the `tweet_service` service, which has the following
methods (see `TweetService.php` for details):

Tweets are short messages created by a tweeter. When creating a tweet, the 
tweeter entity is created automatically if it does not already exist.

* getRecentTweets
* getRecentTweetsForTweeter
* createTweet

To get a list of recent tweets in a controller:

    $service = $this->get('finalist_tweeter_core.tweet_service');
    $tweets = $service->getRecentTweets();
    // do something with $tweets

