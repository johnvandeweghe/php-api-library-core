<?php
namespace PHPAPILibrary\Core\Identity\Response;

use PHPAPILibrary\Core\CacheControlInterface;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\StreamInterface;

class ResponseTest extends TestCase
{
    public function testGettersReturnConstructedValues() {
        $mockedCacheControl = $this->getMockBuilder(CacheControlInterface::class)->getMock();
        $data = null;

        $response = new Response($mockedCacheControl, $data);

        $this->assertEquals($mockedCacheControl, $response->getCacheControl());
        $this->assertEquals($data, $response->getData());
    }
}
