<?php
namespace PHPAPILibrary\Core\Data\CacheController;

use PHPUnit\Framework\TestCase;

class NullCacheControllerTest extends TestCase
{
    public function testGetResponseReturnsNull() {
        $mockedRequest = $this->getMockBuilder('\PHPAPILibrary\Core\Data\RequestInterface')->getMock();
        $cacheController = new NullCacheController();

        $response = $cacheController->getResponse($mockedRequest);

        $this->assertNull($response);
    }
}
