<?php
namespace PHPAPILibrary\Core\Network;

use PHPAPILibrary\Core\CacheControl\NoCacheControl;
use PHPAPILibrary\Core\Network\Exception\AccessDeniedException;
use PHPAPILibrary\Core\Network\Exception\RateLimitExceededException;
use PHPAPILibrary\Core\Network\Exception\UnableToProcessRequestException;
use PHPUnit\Framework\TestCase;

class AbstractLayerControllerTest extends TestCase
{
    public function testLogsAndThrowsRateLimitExceededExceptionOnRateLimitExceeded() {
        $mockedRateController = $this->getMockBuilder(RateControllerInterface::class)->getMock();
        $mockedRateController->method('isExceedingLimit')->willReturn(true);

        $mockedLogger = $this->getMockBuilder(LoggerInterface::class)->getMock();

        $mockedRequest = $this->getMockBuilder(RequestInterface::class)->getMock();

        $layerController = $this->getMockForAbstractClass(AbstractLayerController::class);
        $layerController->method('getRateController')->willReturn($mockedRateController);
        $layerController->method('getLogger')->willReturn($mockedLogger);

        $mockedLogger->expects($this->once())->method('logResponseException')->willReturnCallback(
            function(RequestInterface $request, UnableToProcessRequestException $exception) use ($mockedRequest){
                $this->assertEquals($mockedRequest, $request);

                $this->assertInstanceOf(NoCacheControl::class, $exception->getResponse()->getCacheControl());
                $this->assertNull($exception->getResponse()->getData());
            }
        );
        $this->expectException(RateLimitExceededException::class);

        /**
         * @var AbstractLayerController $layerController
         */
        $layerController->handleRequest($mockedRequest);
    }

    public function testLogsAndThrowsAccessDeniedExceptionOnAccessDenied() {
        $mockedRateController = $this->getMockBuilder(RateControllerInterface::class)->getMock();
        $mockedRateController->method('isExceedingLimit')->willReturn(false);

        $mockedAccessController = $this->getMockBuilder(AccessControllerInterface::class)->getMock();
        $mockedAccessController->method('canAccess')->willReturn(false);

        $mockedLogger = $this->getMockBuilder(LoggerInterface::class)->getMock();

        $mockedRequest = $this->getMockBuilder(RequestInterface::class)->getMock();

        $layerController = $this->getMockForAbstractClass(AbstractLayerController::class);
        $layerController->method('getRateController')->willReturn($mockedRateController);
        $layerController->method('getAccessController')->willReturn($mockedAccessController);
        $layerController->method('getLogger')->willReturn($mockedLogger);

        $mockedLogger->expects($this->once())->method('logResponseException')->willReturnCallback(
            function(RequestInterface $request, UnableToProcessRequestException $exception) use ($mockedRequest){
                $this->assertEquals($mockedRequest, $request);

                $this->assertInstanceOf(NoCacheControl::class, $exception->getResponse()->getCacheControl());
                $this->assertNull($exception->getResponse()->getData());
            }
        );
        $this->expectException(AccessDeniedException::class);

        /**
         * @var AbstractLayerController $layerController
         */
        $layerController->handleRequest($mockedRequest);
    }

    public function testDoesNotCallGetResponseWhenCachedButStillTracksAndLogsAndReturnsResponse() {
        $mockedRateController = $this->getMockBuilder(RateControllerInterface::class)->getMock();
        $mockedRateController->method('isExceedingLimit')->willReturn(false);

        $mockedAccessController = $this->getMockBuilder(AccessControllerInterface::class)->getMock();
        $mockedAccessController->method('canAccess')->willReturn(true);

        $mockedResponse = $this->getMockBuilder(ResponseInterface::class)->getMock();

        $mockedCacheController = $this->getMockBuilder(CacheControllerInterface::class)->getMock();
        $mockedCacheController->method('getResponse')->willReturn($mockedResponse);

        $mockedLogger = $this->getMockBuilder(LoggerInterface::class)->getMock();

        $mockedRequest = $this->getMockBuilder(RequestInterface::class)->getMock();

        $layerController = $this->getMockForAbstractClass(AbstractLayerController::class);
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
        $mockedRateController = $this->getMockBuilder(RateControllerInterface::class)->getMock();
        $mockedRateController->method('isExceedingLimit')->willReturn(false);

        $mockedAccessController = $this->getMockBuilder(AccessControllerInterface::class)->getMock();
        $mockedAccessController->method('canAccess')->willReturn(true);

        $mockedCacheController = $this->getMockBuilder(CacheControllerInterface::class)->getMock();
        $mockedCacheController->method('getResponse')->willReturn(null);

        $mockedLogger = $this->getMockBuilder(LoggerInterface::class)->getMock();

        $mockedRequest = $this->getMockBuilder(RequestInterface::class)->getMock();

        $mockedResponse = $this->getMockBuilder(ResponseInterface::class)->getMock();

        $layerController = $this->getMockForAbstractClass(AbstractLayerController::class);
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
