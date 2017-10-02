<?php
namespace PHPAPILibrary\Core\CacheControl;

use PHPUnit\Framework\TestCase;

class NoCacheControlTest extends TestCase
{
    public function testIsExpiredReturnsTrue(){
        $cacheControl = new NoCacheControl();

        $this->assertTrue($cacheControl->isExpired());
    }

    public function testAbsoluteExpirationIsInPast(){
        $cacheControl = new NoCacheControl();

        $absoluteExpiration = $cacheControl->getAbsoluteExpiration();

        $this->assertLessThan(new \DateTime(), $absoluteExpiration);
    }

    public function testRelativeExpirationIsInPast(){
        $cacheControl = new NoCacheControl();

        $relativeExpiration = $cacheControl->getRelativeExpiration();

        $this->assertEquals(0, $relativeExpiration->invert);
    }
}
