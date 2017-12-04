<?php
namespace PHPAPILibrary\Core\Data\Response;

use PHPAPILibrary\Core\CacheControlInterface;
use PHPAPILibrary\Core\Data\DataInterface;
use PHPUnit\Framework\TestCase;

class ResponseTest extends TestCase
{
    public function testGettersReturnConstructedValues() {
        $mockedCacheControl = $this->getMockBuilder(CacheControlInterface::class)->getMock();
        $mockedData = $this->getMockBuilder(DataInterface::class)->getMock();

        $response = new Response($mockedCacheControl, $mockedData);

        $this->assertEquals($mockedCacheControl, $response->getCacheControl());
        $this->assertEquals($mockedData, $response->getData());
    }
}
