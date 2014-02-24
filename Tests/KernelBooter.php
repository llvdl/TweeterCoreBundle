<?php

namespace Llvdl\TweeterCoreBundle\Tests;

trait KernelBooter {

    private function bootKernel() {
        self::$kernel = static::createKernel();
        self::$kernel->boot();
    }
}
