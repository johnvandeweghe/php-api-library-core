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
        $mockedRateController = $this->getMockBuilder('\PHPAPILibrary\Core\Data\RateControllerInterface')->getMock();
        $mockedRateController->method('isExceedingLimit')->willReturn(false);

        $mockedAccessController = $this->getMockBuilder('\PHPAPILibrary\Core\Data\AccessControllerInterface')->getMock();
        $mockedAccessController->method('canAccess')->willReturn(false);

        $mockedLogger = $this->getMockBuilder('\PHPAPILibrary\Core\Data\LoggerInterface')->getMock();

        $mockedRequest = $this->getMockBuilder('\PHPAPILibrary\Core\Data\RequestInterface')->getMock();

        $layerController = $this->getMockForAbstractClass('\PHPAPILibrary\Core\Data\AbstractLayerController');
        $layerController->method('getRateController')->willReturn($mockedRateController);
        $layerController->method('getAccessController')->willReturn($mockedAccessController);
        $layerController->method('getLogger')->willReturn($mockedLogger);

        $mockedLogger->expects($this->once())->method('logResponseException')->willReturnCallback(
            function(RequestInterface $request, UnableToProcessRequestException $exception) use ($mockedRequest){
                $this->assertEquals($mockedRequest, $request);

                $this->assertInstanceOf('\PHPAPILibrary\Core\CacheControl\NoCacheControl', $exception->getResponse()->getCacheControl());
                $this->assertNull($exception->getResponse()->getData());
            }
        );
        $this->expectException('PHPAPILibrary\Core\Data\Exception\AccessDeniedException');

        /**
         * @var AbstractLayerController $layerController
         */
        $layerController->handleRequest($mockedRequest);
    }

    public function testDoesNotCallGetResponseWhenCachedButStillTracksAndLogsAndReturnsResponse() {
        $mockedRateController = $this->getMockBuilder('\PHPAPILibrary\Core\Data\RateControllerInterface')->getMock();
        $mockedRateController->method('isExceedingLimit')->willReturn(false);

        $mockedAccessController = $this->getMockBuilder('\PHPAPILibrary\Core\Data\AccessControllerInterface')->getMock();
        $mockedAccessController->method('canAccess')->willReturn(true);

        $mockedResponse = $this->getMockBuilder('\PHPAPILibrary\Core\Data\ResponseInterface')->getMock();

        $mockedCacheController = $this->getMockBuilder('\PHPAPILibrary\Core\Data\CacheControllerInterface')->getMock();
        $mockedCacheController->method('getResponse')->willReturn($mockedResponse);

        $mockedLogger = $this->getMockBuilder('\PHPAPILibrary\Core\Data\LoggerInterface')->getMock();

        $mockedRequest = $this->getMockBuilder('\PHPAPILibrary\Core\Data\RequestInterface')->getMock();

        $layerController = $this->getMockForAbstractClass('\PHPAPILibrary\Core\Data\AbstractLayerController');
        $layerController->method('getRateController')->willReturn($mockedRateController);
        $layerController->method('getAccessController')->willReturn($mockedAccessController);
        $layerController->method('getCacheController')->willReturn($mockedCacheController);
        $layerController->method('getLogger')->willReturn($mockedLogger);

        $mockedRateController->expects($this->once())->method('trackRequest')->with($mockedRequest);
        $mockedLogger->expects($this->once())->method('logResponse')->with($mockedRequest, $mockedResponse);

        /**
         * @var AbstractLayerController $layerController
         */
        $response = $layerController->handleRequest($mockedRequest);

        $this->assertEquals($mockedResponse, $response);
    }

    public function testCallsGetResponseWhenNotCachedAndCachesAndTracksAndLogsAndReturnsResponse() {
        $mockedRateController = $this->getMockBuilder('\PHPAPILibrary\Core\Data\RateControllerInterface')->getMock();
        $mockedRateController->method('isExceedingLimit')->willReturn(false);

        $mockedAccessController = $this->getMockBuilder('\PHPAPILibrary\Core\Data\AccessControllerInterface')->getMock();
        $mockedAccessController->method('canAccess')->willReturn(true);

        $mockedCacheController = $this->getMockBuilder('\PHPAPILibrary\Core\Data\CacheControllerInterface')->getMock();
        $mockedCacheController->method('getResponse')->willReturn(null);

        $mockedLogger = $this->getMockBuilder('\PHPAPILibrary\Core\Data\LoggerInterface')->getMock();

        $mockedRequest = $this->getMockBuilder('\PHPAPILibrary\Core\Data\RequestInterface')->getMock();

        $mockedResponse = $this->getMockBuilder('\PHPAPILibrary\Core\Data\ResponseInterface')->getMock();

        $layerController = $this->getMockForAbstractClass('\PHPAPILibrary\Core\Data\AbstractLayerController');
        $layerController->method('getRateController')->willReturn($mockedRateController);
        $layerController->method('getAccessController')->willReturn($mockedAccessController);
        $layerController->method('getCacheController')->willReturn($mockedCacheController);
        $layerController->method('getLogger')->willReturn($mockedLogger);
        $layerController->method('getResponse')->willReturn($mockedResponse);

        $mockedCacheController->expects($this->once())->method('storeResponse')->with($mockedRequest, $mockedResponse);
        $mockedRateController->expects($this->once())->method('trackRequest')->with($mockedRequest);
        $mockedLogger->expects($this->once())->method('logResponse')->with($mockedRequest, $mockedResponse);

        /**
         * @var AbstractLayerController $layerController
         */
        $response = $layerController->handleRequest($mockedRequest);

        $this->assertEquals($mockedResponse, $response);
    }
}
