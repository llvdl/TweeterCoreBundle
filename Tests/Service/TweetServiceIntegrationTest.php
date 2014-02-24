<?php

namespace Llvdl\TweeterCoreBundle\Tests\Service;

use Liip\FunctionalTestBundle\Test\WebTestCase;

class TweetServiceIntegrationTest extends WebTestCase {

    use \Llvdl\TweeterCoreBundle\Tests\KernelBooter;

    public function setUp() {
        $this->bootKernel();
    }

    public function testGetService() {
        $service = self::$kernel->getContainer()->get('llvdl_tweeter_core.tweet_service');
        $this->assertNotNull($service);
    }

}
