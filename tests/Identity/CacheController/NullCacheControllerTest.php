<?php
namespace PHPAPILibrary\Core\Identity\CacheController;

use PHPAPILibrary\Core\Identity\RequestInterface;
use PHPUnit\Framework\TestCase;

class NullCacheControllerTest extends TestCase
{
    public function testGetResponseReturnsNull() {
        $mockedRequest = $this->getMockBuilder(RequestInterface::class)->getMock();
        $cacheController = new NullCacheController();

        $response = $cacheController->getResponse($mockedRequest);

        $this->assertNull($response);
    }
}
