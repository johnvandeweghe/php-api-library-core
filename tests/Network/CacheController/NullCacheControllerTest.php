<?php
namespace PHPAPILibrary\Core\Network\CacheController;

use PHPAPILibrary\Core\Network\RequestInterface;
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
