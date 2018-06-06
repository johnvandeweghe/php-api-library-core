<?php
namespace PHPAPILibrary\Core\Network\In;

use PHPAPILibrary\Core\CacheControl\NoCacheControl;
use PHPAPILibrary\Core\Network\AbstractRoutingLayerController;
use PHPAPILibrary\Core\Network\AccessControllerInterface;
use PHPAPILibrary\Core\Network\CacheControllerInterface;
use PHPAPILibrary\Core\Network\Exception\UnableToProcessRequestException;
use PHPAPILibrary\Core\Network\Exception\UnableToRouteRequestException;
use PHPAPILibrary\Core\Network\LayerControllerInterface;
use PHPAPILibrary\Core\Network\LoggerInterface;
use PHPAPILibrary\Core\Network\RateControllerInterface;
use PHPAPILibrary\Core\Network\RequestInterface;
use PHPAPILibrary\Core\Network\ResponseInterface;
use PHPAPILibrary\Core\Network\RouterInterface;
use PHPUnit\Framework\TestCase;

class AbstractRoutingLayerControllerTest extends TestCase
{
    public function testGetResponseGetsRouterAndRoutesRequest() {
        $mockedRateController = $this->getMockBuilder(RateControllerInterface::class)->getMock();
        $mockedRateController->method('isExceedingLimit')->willReturn(false);

        $mockedAccessController = $this->getMockBuilder(AccessControllerInterface::class)->getMock();
        $mockedAccessController->method('canAccess')->willReturn(true);

        $mockedCacheController = $this->getMockBuilder(CacheControllerInterface::class)->getMock();
        $mockedCacheController->method('getResponse')->willReturn(null);

        $mockedLogger = $this->getMockBuilder(LoggerInterface::class)->getMock();

        $mockedRequest = $this->getMockBuilder(RequestInterface::class)->getMock();

        $mockedResponse = $this->getMockBuilder(ResponseInterface::class)->getMock();

        $mockedRouter = $this->getMockBuilder(RouterInterface::class)->getMock();

        $mockedLayerController = $this->getMockBuilder(LayerControllerInterface::class)->getMock();

        $layerController = $this->getMockForAbstractClass(AbstractRoutingLayerController::class);
        $layerController->method('getRateController')->willReturn($mockedRateController);
        $layerController->method('getAccessController')->willReturn($mockedAccessController);
        $layerController->method('getCacheController')->willReturn($mockedCacheController);
        $layerController->method('getLogger')->willReturn($mockedLogger);
        $layerController->method('getRouter')->willReturn($mockedRouter);

        $mockedCacheController->expects($this->once())->method('storeResponse')->with($mockedRequest, $mockedResponse);
        $mockedRateController->expects($this->once())->method('trackRequest')->with($mockedRequest);
        $mockedLogger->expects($this->once())->method('logResponse')->with($mockedRequest, $mockedResponse);
        $mockedRouter->expects($this->once())->method('route')->with($mockedRequest)->willReturn($mockedLayerController);
        $mockedLayerController->expects($this->once())->method('handleRequest')->with($mockedRequest)->willReturn($mockedResponse);

        /**
         * @var AbstractLayerController $layerController
         */
        $response = $layerController->handleRequest($mockedRequest);

        $this->assertEquals($mockedResponse, $response);
    }
    public function testGetResponseGetsRouterAndThrowsUnableToRoute() {
        $mockedRateController = $this->getMockBuilder(RateControllerInterface::class)->getMock();
        $mockedRateController->method('isExceedingLimit')->willReturn(false);

        $mockedAccessController = $this->getMockBuilder(AccessControllerInterface::class)->getMock();
        $mockedAccessController->method('canAccess')->willReturn(true);

        $mockedCacheController = $this->getMockBuilder(CacheControllerInterface::class)->getMock();
        $mockedCacheController->method('getResponse')->willReturn(null);

        $mockedLogger = $this->getMockBuilder(LoggerInterface::class)->getMock();

        $mockedRequest = $this->getMockBuilder(RequestInterface::class)->getMock();

        $mockedRouter = $this->getMockBuilder(RouterInterface::class)->getMock();

        $layerController = $this->getMockForAbstractClass(AbstractRoutingLayerController::class);
        $layerController->method('getRateController')->willReturn($mockedRateController);
        $layerController->method('getAccessController')->willReturn($mockedAccessController);
        $layerController->method('getCacheController')->willReturn($mockedCacheController);
        $layerController->method('getLogger')->willReturn($mockedLogger);
        $layerController->method('getRouter')->willReturn($mockedRouter);

        $mockedLogger->expects($this->once())->method('logResponseException')->willReturnCallback(
            function(RequestInterface $request, UnableToProcessRequestException $exception) use ($mockedRequest){
                $this->assertEquals($mockedRequest, $request);

                $this->assertInstanceOf(NoCacheControl::class, $exception->getResponse()->getCacheControl());
                $this->assertNull($exception->getResponse()->getData());
            }
        );
        $mockedRouter->expects($this->once())->method('route')->with($mockedRequest)->willReturn(null);

        $this->expectException(UnableToRouteRequestException::class);

        /**
         * @var AbstractLayerController $layerController
         */
        $layerController->handleRequest($mockedRequest);
    }
}
