<?php
namespace PHPAPILibrary\Core\Identity\In;

use PHPAPILibrary\Core\Identity\AccessControllerInterface;
use PHPAPILibrary\Core\Identity\CacheControllerInterface;
use PHPAPILibrary\Core\Identity\LoggerInterface;
use PHPAPILibrary\Core\Identity\RateControllerInterface;

/**
 * Default implementation of an AbstractLayerController.
 * Class LayerController
 * @package PHPAPILibrary\Core\Identity\In
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
     * @var \PHPAPILibrary\Core\Data\LayerControllerInterface
     */
    private $dataLayerController;
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
     * @param \PHPAPILibrary\Core\Data\LayerControllerInterface $dataLayerController
     * @param RequestTranslatorInterface $requestTranslator
     * @param ResponseTranslatorInterface $responseTranslator
     */
    public function __construct(
        AccessControllerInterface $accessController,
        RateControllerInterface $rateController,
        CacheControllerInterface $cacheController,
        LoggerInterface $logger,
        \PHPAPILibrary\Core\Data\LayerControllerInterface $dataLayerController,
        RequestTranslatorInterface $requestTranslator,
        ResponseTranslatorInterface $responseTranslator
    )
    {
        $this->accessController = $accessController;
        $this->rateController = $rateController;
        $this->cacheController = $cacheController;
        $this->logger = $logger;
        $this->dataLayerController = $dataLayerController;
        $this->requestTranslator = $requestTranslator;
        $this->responseTranslator = $responseTranslator;
    }

    /**
     * @return AccessControllerInterface
     */
    public function getAccessController(): AccessControllerInterface
    {
        return $this->accessController;
    }

    /**
     * @return RateControllerInterface
     */
    public function getRateController(): RateControllerInterface
    {
        return $this->rateController;
    }

    /**
     * @return CacheControllerInterface
     */
    public function getCacheController(): CacheControllerInterface
    {
        return $this->cacheController;
    }

    /**
     * @return LoggerInterface
     */
    public function getLogger(): LoggerInterface
    {
        return $this->logger;
    }

    /**
     * @return \PHPAPILibrary\Core\Data\LayerControllerInterface
     */
    public function getNextLayer(): \PHPAPILibrary\Core\Data\LayerControllerInterface
    {
        return $this->dataLayerController;
    }

    /**
     * @return RequestTranslatorInterface
     */
    public function getRequestTranslator(): RequestTranslatorInterface
    {
        return $this->requestTranslator;
    }

    /**
     * @return ResponseTranslatorInterface
     */
    public function getResponseTranslator(): ResponseTranslatorInterface
    {
        return $this->responseTranslator;
    }


}
