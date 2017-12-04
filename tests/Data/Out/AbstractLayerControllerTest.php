<?php
namespace PHPAPILibrary\Core\Data\Out;

use PHPAPILibrary\Core\Data\AccessControllerInterface;
use PHPAPILibrary\Core\Data\CacheControllerInterface;
use PHPAPILibrary\Core\Data\LoggerInterface;
use PHPAPILibrary\Core\Data\RateControllerInterface;
use PHPAPILibrary\Core\Data\RequestInterface;
use PHPAPILibrary\Core\Data\ResponseInterface;
use PHPAPILibrary\Core\Identity\LayerControllerInterface;
use PHPAPILibrary\Core\Identity\RequestInterface as IdentityRequestInterface;
use PHPAPILibrary\Core\Identity\ResponseInterface as IdentityResponseInterface;

class AbstractLayerControllerTest extends \PHPAPILibrary\Core\Data\AbstractLayerControllerTest
{
    public function testTranslatorsAreCalledWithRequestAndThatTheProxiedResponseIsTranslatedAndReturned() {
        $mockedRequest = $this->getMockBuilder(RequestInterface::class)->getMock();
        $mockedResponse = $this->getMockBuilder(ResponseInterface::class)->getMock();
        $mockedTranslatedRequest = $this->getMockBuilder(IdentityRequestInterface::class)->getMock();
        $mockedTranslatedResponse = $this->getMockBuilder(IdentityResponseInterface::class)->getMock();
        $mockedNextLayer = $this->getMockBuilder(LayerControllerInterface::class)->getMock();
        $mockedRequestTranslator = $this->getMockBuilder(RequestTranslatorInterface::class)->getMock();
        $mockedResponseTranslator = $this->getMockBuilder(ResponseTranslatorInterface::class)->getMock();

        $mockedRateController = $this->getMockBuilder(RateControllerInterface::class)->getMock();
        $mockedRateController->method('isExceedingLimit')->willReturn(false);
        $mockedRateController->method('trackRequest')->with($mockedRequest);
        $mockedAccessController = $this->getMockBuilder(AccessControllerInterface::class)->getMock();
        $mockedAccessController->method('canAccess')->willReturn(true);
        $mockedCacheController = $this->getMockBuilder(CacheControllerInterface::class)->getMock();
        $mockedCacheController->method('getResponse')->willReturn(null);
        $mockedCacheController->method('storeResponse')->with($mockedRequest, $mockedResponse);
        $mockedLogger = $this->getMockBuilder(LoggerInterface::class)->getMock();
        $mockedLogger->method('logResponse')->with($mockedRequest, $mockedResponse);

        $layerController = $this->getMockForAbstractClass(AbstractLayerController::class);
        $layerController->method('getNextLayer')->willReturn($mockedNextLayer);
        $layerController->method('getRequestTranslator')->willReturn($mockedRequestTranslator);
        $layerController->method('getResponseTranslator')->willReturn($mockedResponseTranslator);
        $layerController->method('getRateController')->willReturn($mockedRateController);
        $layerController->method('getAccessController')->willReturn($mockedAccessController);
        $layerController->method('getCacheController')->willReturn($mockedCacheController);
        $layerController->method('getLogger')->willReturn($mockedLogger);

        $mockedRequestTranslator->expects($this->once())->method("translateRequest")->with($mockedRequest)->willReturn($mockedTranslatedRequest);
        $mockedNextLayer->expects($this->once())->method("handleRequest")->with($mockedTranslatedRequest)->willReturn($mockedTranslatedResponse);
        $mockedResponseTranslator->expects($this->once())->method("translateResponse")->with($mockedTranslatedResponse)->willReturn($mockedResponse);

        /**
         * @var AbstractLayerController $layerController
         */
        $this->assertEquals($mockedResponse, $layerController->handleRequest($mockedRequest));
    }
    //Test that """                                                               """ throws an exception, it is translated to this layer's exception (with a translated response) and thrown
    //  - For each exception type (access/rate/general)
}
