<?php
namespace PHPAPILibrary\Core\Network\Response;

use PHPAPILibrary\Core\CacheControlInterface;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\StreamInterface;

class ResponseTest extends TestCase
{
    public function testGettersReturnConstructedValues() {
        $mockedCacheControl = $this->getMockBuilder(CacheControlInterface::class)->getMock();
        $mockedStream = $this->getMockBuilder(StreamInterface::class)->getMock();

        $response = new Response($mockedCacheControl, $mockedStream);

        $this->assertEquals($mockedCacheControl, $response->getCacheControl());
        $this->assertEquals($mockedStream, $response->getData());
    }
}
