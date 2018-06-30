<?php
namespace PHPAPILibrary\Core\CacheControl;

use PHPUnit\Framework\TestCase;

class NoCacheControlTest extends TestCase
{
    public function testIsPrivateReturnsTrue(){
        $cacheControl = new NoCacheControl();

        $this->assertTrue($cacheControl->isPrivate());
    }

    public function testRelativeExpirationIsInPast(){
        $cacheControl = new NoCacheControl();

        $relativeExpiration = $cacheControl->getRelativeExpiration();

        $this->assertEquals(0, $relativeExpiration->invert);
    }
}
