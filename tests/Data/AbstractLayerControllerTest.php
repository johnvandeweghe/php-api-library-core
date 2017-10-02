<?php
namespace PHPAPILibrary\Core\Data;

use PHPAPILibrary\Core\Data\Exception\UnableToProcessRequestException;
use PHPUnit\Framework\TestCase;

class AbstractLayerControllerTest extends TestCase
{
    public function testLogsAndThrowsRateLimitExceededExceptionOnRateLimitExceeded() {
        $mockedRateController = $this->getMockBuilder('\PHPAPILibrary\Core\Data\RateControllerInterface')->getMock();
        $mockedRateController->method('isExceedingLimit')->willReturn(true);

        $mockedLogger = $this->getMockBuilder('\PHPAPILibrary\Core\Data\LoggerInterface')->getMock();

        $mockedRequest = $this->getMockBuilder('\PHPAPILibrary\Core\Data\RequestInterface')->getMock();

        $layerController = $this->getMockForAbstractClass('\PHPAPILibrary\Core\Data\AbstractLayerController');
        $layerController->method('getRateController')->willReturn($mockedRateController);
        $layerController->method('getLogger')->willReturn($mockedLogger);

        $mockedLogger->expects($this->once())->method('logResponseException')->willReturnCallback(
            function(RequestInterface $request, UnableToProcessRequestException $exception) use ($mockedRequest){
                $this->assertEquals($mockedRequest, $request);

                $this->assertInstanceOf('\PHPAPILibrary\Core\CacheControl\NoCacheControl', $exception->getResponse()->getCacheControl());
                $this->assertNull($exception->getResponse()->getData());
            }
        );
        $this->expectException('PHPAPILibrary\Core\Data\Exception\RateLimitExceededException');

        /**
         * @var AbstractLayerController $layerController
         */
        $layerController->handleRequest($mockedRequest);
    }

    public function testLogsAndThrowsAccessDeniedExceptionOnAccessDenied() {
//        $mockedRateController = $this->getMockBuilder('\PHPAPILibrary\Core\Data\RateControllerInterface')->getMock();
//        $mockedRateController->method('isExceedingLimit')->willReturn(true);
//
//        $mockedLogger = $this->getMockBuilder('\PHPAPILibrary\Core\Data\LoggerInterface')->getMock();
//
//        $mockedRequest = $this->getMockBuilder('\PHPAPILibrary\Core\Data\RequestInterface')->getMock();
//
//        $layerController = $this->getMockForAbstractClass('\PHPAPILibrary\Core\Data\AbstractLayerController');
//        $layerController->method('getRateController')->willReturn($mockedRateController);
//        $layerController->method('getLogger')->willReturn($mockedLogger);
//
//        $mockedLogger->expects($this->once())->method('logResponseException')->willReturnCallback(
//            function(RequestInterface $request, UnableToProcessRequestException $exception) use ($mockedRequest){
//                $this->assertEquals($mockedRequest, $request);
//
//                $this->assertInstanceOf('\PHPAPILibrary\Core\CacheControl\NoCacheControl', $exception->getResponse()->getCacheControl());
//                $this->assertNull($exception->getResponse()->getData());
//            }
//        );
//        $this->expectException('PHPAPILibrary\Core\Data\Exception\RateLimitExceededException');
//
//        /**
//         * @var AbstractLayerController $layerController
//         */
//        $layerController->handleRequest($mockedRequest);
    }

    public function testDoesNotCallGetResponseWhenCachedButStillTracksAndLogsAndReturnsResponse() {

    }

    public function testCallsGetResponseWhenNotCachedAndCachesAndTracksAndLogsAndReturnsResponse() {

    }
}
