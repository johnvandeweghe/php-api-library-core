<?php
namespace PHPAPILibrary\Core\Network\In;

use PHPAPILibrary\Core\Network\AccessControllerInterface;
use PHPAPILibrary\Core\Network\CacheControllerInterface;
use PHPAPILibrary\Core\Network\Exception\AccessDeniedException;
use PHPAPILibrary\Core\Network\Exception\RateLimitExceededException;
use PHPAPILibrary\Core\Network\Exception\RequestException;
use PHPAPILibrary\Core\Network\Exception\UnableToProcessRequestException;
use PHPAPILibrary\Core\Network\LoggerInterface;
use PHPAPILibrary\Core\Network\RateControllerInterface;
use PHPAPILibrary\Core\Network\RequestInterface;
use PHPAPILibrary\Core\Network\ResponseInterface;
use PHPAPILibrary\Core\Data\Exception\AccessDeniedException as DataAccessDeniedException;
use PHPAPILibrary\Core\Data\Exception\RateLimitExceededException as DataRateLimitExceededException;
use PHPAPILibrary\Core\Data\Exception\RequestException as DataRequestException;
use PHPAPILibrary\Core\Data\Exception\UnableToProcessRequestException as DataUnableToProcessRequestException;
use PHPAPILibrary\Core\Data\LayerControllerInterface;
use PHPAPILibrary\Core\Data\RequestInterface as DataRequestInterface;
use PHPAPILibrary\Core\Data\ResponseInterface as DataResponseInterface;
use PHPUnit\Framework\TestCase;

class AbstractLayerControllerTest extends TestCase
{
    protected function getLayerController(
        AccessControllerInterface $accessController,
        RateControllerInterface $rateController,
        CacheControllerInterface $cacheController,
        LoggerInterface $logger,
        \PHPAPILibrary\Core\Data\LayerControllerInterface $nextLayerController,
        RequestTranslatorInterface $requestTranslator,
        ResponseTranslatorInterface $responseTranslator
    ): \PHPAPILibrary\Core\Network\LayerControllerInterface
    {
        $layerController = $this->getMockForAbstractClass(AbstractLayerController::class);
        $layerController->method('getNextLayer')->willReturn($nextLayerController);
        $layerController->method('getRequestTranslator')->willReturn($requestTranslator);
        $layerController->method('getResponseTranslator')->willReturn($responseTranslator);
        $layerController->method('getRateController')->willReturn($rateController);
        $layerController->method('getAccessController')->willReturn($accessController);
        $layerController->method('getCacheController')->willReturn($cacheController);
        $layerController->method('getLogger')->willReturn($logger);

        return $layerController;
    }

    public function testTranslatorsAreCalledWithRequestAndThatTheProxiedResponseIsTranslatedAndReturned() {
        $mockedRequest = $this->getMockBuilder(RequestInterface::class)->getMock();
        $mockedResponse = $this->getMockBuilder(ResponseInterface::class)->getMock();
        $mockedTranslatedRequest = $this->getMockBuilder(DataRequestInterface::class)->getMock();
        $mockedTranslatedResponse = $this->getMockBuilder(DataResponseInterface::class)->getMock();
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

        $layerController = $this->getLayerController(
            $mockedAccessController,
            $mockedRateController,
            $mockedCacheController,
            $mockedLogger,
            $mockedNextLayer,
            $mockedRequestTranslator,
            $mockedResponseTranslator
        );

        $mockedRequestTranslator->expects($this->once())->method("translateRequest")->with($mockedRequest)->willReturn($mockedTranslatedRequest);
        $mockedNextLayer->expects($this->once())->method("handleRequest")->with($mockedTranslatedRequest)->willReturn($mockedTranslatedResponse);
        $mockedResponseTranslator->expects($this->once())->method("translateResponse")->with($mockedTranslatedResponse)->willReturn($mockedResponse);

        /**
         * @var AbstractLayerController $layerController
         */
        $this->assertEquals($mockedResponse, $layerController->handleRequest($mockedRequest));
    }

    public function testTranslatorsAreCalledWithRequestAndThatTheProxiedResponseIsTranslatedAndReturnedWhenAccessDenied() {
        $mockedRequest = $this->getMockBuilder(RequestInterface::class)->getMock();
        $mockedResponse = $this->getMockBuilder(ResponseInterface::class)->getMock();
        $mockedTranslatedRequest = $this->getMockBuilder(DataRequestInterface::class)->getMock();
        $mockedTranslatedResponse = $this->getMockBuilder(DataResponseInterface::class)->getMock();
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

        $layerController = $this->getLayerController(
            $mockedAccessController,
            $mockedRateController,
            $mockedCacheController,
            $mockedLogger,
            $mockedNextLayer,
            $mockedRequestTranslator,
            $mockedResponseTranslator
        );

        $mockedRequestTranslator->expects($this->once())->method("translateRequest")->with($mockedRequest)->willReturn($mockedTranslatedRequest);
        $mockedNextLayer->expects($this->once())->method("handleRequest")->with($mockedTranslatedRequest)->willThrowException(new DataAccessDeniedException($mockedTranslatedResponse));
        $mockedResponseTranslator->expects($this->once())->method("translateResponse")->with($mockedTranslatedResponse)->willReturn($mockedResponse);

        /**
         * @var AbstractLayerController $layerController
         */
        try {
            $layerController->handleRequest($mockedRequest);
            $this->fail("Expected AccessDeniedException");
        } catch (AccessDeniedException $exception) {
            $this->assertEquals($mockedResponse, $exception->getResponse());
        }
    }

    public function testTranslatorsAreCalledWithRequestAndThatTheProxiedResponseIsTranslatedAndReturnedWhenRateLimited() {
        $mockedRequest = $this->getMockBuilder(RequestInterface::class)->getMock();
        $mockedResponse = $this->getMockBuilder(ResponseInterface::class)->getMock();
        $mockedTranslatedRequest = $this->getMockBuilder(DataRequestInterface::class)->getMock();
        $mockedTranslatedResponse = $this->getMockBuilder(DataResponseInterface::class)->getMock();
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

        $layerController = $this->getLayerController(
            $mockedAccessController,
            $mockedRateController,
            $mockedCacheController,
            $mockedLogger,
            $mockedNextLayer,
            $mockedRequestTranslator,
            $mockedResponseTranslator
        );

        $mockedRequestTranslator->expects($this->once())->method("translateRequest")->with($mockedRequest)->willReturn($mockedTranslatedRequest);
        $mockedNextLayer->expects($this->once())->method("handleRequest")->with($mockedTranslatedRequest)->willThrowException(new DataRateLimitExceededException($mockedTranslatedResponse));
        $mockedResponseTranslator->expects($this->once())->method("translateResponse")->with($mockedTranslatedResponse)->willReturn($mockedResponse);

        /**
         * @var AbstractLayerController $layerController
         */
        try {
            $layerController->handleRequest($mockedRequest);
            $this->fail("Expected RateLimitExceededException");
        } catch (RateLimitExceededException $exception) {
            $this->assertEquals($mockedResponse, $exception->getResponse());
        }
    }

    public function testTranslatorsAreCalledWithRequestAndThatTheProxiedResponseIsTranslatedAndReturnedWhenRequestException() {
        $mockedRequest = $this->getMockBuilder(RequestInterface::class)->getMock();
        $mockedResponse = $this->getMockBuilder(ResponseInterface::class)->getMock();
        $mockedTranslatedRequest = $this->getMockBuilder(DataRequestInterface::class)->getMock();
        $mockedTranslatedResponse = $this->getMockBuilder(DataResponseInterface::class)->getMock();
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

        $layerController = $this->getLayerController(
            $mockedAccessController,
            $mockedRateController,
            $mockedCacheController,
            $mockedLogger,
            $mockedNextLayer,
            $mockedRequestTranslator,
            $mockedResponseTranslator
        );

        $mockedRequestTranslator->expects($this->once())->method("translateRequest")->with($mockedRequest)->willReturn($mockedTranslatedRequest);
        $mockedNextLayer->expects($this->once())->method("handleRequest")->with($mockedTranslatedRequest)->willThrowException(new DataRequestException($mockedTranslatedResponse));
        $mockedResponseTranslator->expects($this->once())->method("translateResponse")->with($mockedTranslatedResponse)->willReturn($mockedResponse);

        /**
         * @var AbstractLayerController $layerController
         */
        try {
            $layerController->handleRequest($mockedRequest);
            $this->fail("Expected RequestException");
        } catch (RequestException $exception) {
            $this->assertEquals($mockedResponse, $exception->getResponse());
        }
    }

    public function testTranslatorsAreCalledWithRequestAndThatTheProxiedResponseIsTranslatedAndReturnedWhenUnableToProcessException() {
        $mockedRequest = $this->getMockBuilder(RequestInterface::class)->getMock();
        $mockedResponse = $this->getMockBuilder(ResponseInterface::class)->getMock();
        $mockedTranslatedRequest = $this->getMockBuilder(DataRequestInterface::class)->getMock();
        $mockedTranslatedResponse = $this->getMockBuilder(DataResponseInterface::class)->getMock();
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

        $layerController = $this->getLayerController(
            $mockedAccessController,
            $mockedRateController,
            $mockedCacheController,
            $mockedLogger,
            $mockedNextLayer,
            $mockedRequestTranslator,
            $mockedResponseTranslator
        );

        $mockedRequestTranslator->expects($this->once())->method("translateRequest")->with($mockedRequest)->willReturn($mockedTranslatedRequest);
        $mockedNextLayer->expects($this->once())->method("handleRequest")->with($mockedTranslatedRequest)->willThrowException(new DataUnableToProcessRequestException($mockedTranslatedResponse));
        $mockedResponseTranslator->expects($this->once())->method("translateResponse")->with($mockedTranslatedResponse)->willReturn($mockedResponse);

        /**
         * @var AbstractLayerController $layerController
         */
        try {
            $layerController->handleRequest($mockedRequest);
            $this->fail("Expected UnableToProcessRequestException");
        } catch (UnableToProcessRequestException $exception) {
            $this->assertEquals($mockedResponse, $exception->getResponse());
        }
    }

}
