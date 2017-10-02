<?php
namespace PHPAPILibrary\Core\Data\Response;

use PHPUnit\Framework\TestCase;

class ResponseTest extends TestCase
{
    public function testGettersReturnConstructedValues() {
        $mockedCacheControl = $this->getMockBuilder('\PHPAPILibrary\Core\CacheControlInterface')->getMock();
        $mockedData = $this->getMockBuilder('\PHPAPILibrary\Core\Data\DataInterface')->getMock();

        $response = new Response($mockedCacheControl, $mockedData);

        $this->assertEquals($mockedCacheControl, $response->getCacheControl());
        $this->assertEquals($mockedData, $response->getData());
    }
}
