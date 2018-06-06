<?php
namespace PHPAPILibrary\Core\Data\Out;

use PHPAPILibrary\Core\Data\AccessControllerInterface;
use PHPAPILibrary\Core\Data\CacheControllerInterface;
use PHPAPILibrary\Core\Data\LoggerInterface;
use PHPAPILibrary\Core\Data\RateControllerInterface;

/**
 * Default implementation of an AbstractLayerController.
 * Class LayerController
 * @package PHPAPILibrary\Core\Data\Out
 */
class LayerController extends AbstractLayerController
{
    /**
     * @var AccessControllerInterface
     */
    private $accessController;
    /**
     * @var RateControllerInterface
     */
    private $rateController;
    /**
     * @var CacheControllerInterface
     */
    private $cacheController;
    /**
     * @var LoggerInterface
     */
    private $logger;
    /**
     * @var \PHPAPILibrary\Core\Network\LayerControllerInterface
     */
    private $nextLayerController;
    /**
     * @var RequestTranslatorInterface
     */
    private $requestTranslator;
    /**
     * @var ResponseTranslatorInterface
     */
    private $responseTranslator;

    /**
     * LayerController constructor.
     * @param AccessControllerInterface $accessController
     * @param RateControllerInterface $rateController
     * @param CacheControllerInterface $cacheController
     * @param LoggerInterface $logger
     * @param \PHPAPILibrary\Core\Network\LayerControllerInterface $nextLayerController
     * @param RequestTranslatorInterface $requestTranslator
     * @param ResponseTranslatorInterface $responseTranslator
     */
    public function __construct(
        AccessControllerInterface $accessController,
        RateControllerInterface $rateController,
        CacheControllerInterface $cacheController,
        LoggerInterface $logger,
        \PHPAPILibrary\Core\Network\LayerControllerInterface $nextLayerController,
        RequestTranslatorInterface $requestTranslator,
        ResponseTranslatorInterface $responseTranslator
    )
    {
        $this->accessController = $accessController;
        $this->rateController = $rateController;
        $this->cacheController = $cacheController;
        $this->logger = $logger;
        $this->nextLayerController = $nextLayerController;
        $this->requestTranslator = $requestTranslator;
        $this->responseTranslator = $responseTranslator;
    }

    /**
     * @return AccessControllerInterface
     */
    protected function getAccessController(): AccessControllerInterface
    {
        return $this->accessController;
    }

    /**
     * @return RateControllerInterface
     */
    protected function getRateController(): RateControllerInterface
    {
        return $this->rateController;
    }

    /**
     * @return CacheControllerInterface
     */
    protected function getCacheController(): CacheControllerInterface
    {
        return $this->cacheController;
    }

    /**
     * @return LoggerInterface
     */
    protected function getLogger(): LoggerInterface
    {
        return $this->logger;
    }

    /**
     * @return \PHPAPILibrary\Core\Network\LayerControllerInterface
     */
    protected function getNextLayer(): \PHPAPILibrary\Core\Network\LayerControllerInterface
    {
        return $this->nextLayerController;
    }

    /**
     * @return RequestTranslatorInterface
     */
    protected function getRequestTranslator(): RequestTranslatorInterface
    {
        return $this->requestTranslator;
    }

    /**
     * @return ResponseTranslatorInterface
     */
    protected function getResponseTranslator(): ResponseTranslatorInterface
    {
        return $this->responseTranslator;
    }
}
