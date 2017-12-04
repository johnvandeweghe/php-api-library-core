<?php
namespace PHPAPILibrary\Core\Identity\Out;

use PHPAPILibrary\Core\Identity\AccessControllerInterface;
use PHPAPILibrary\Core\Identity\CacheControllerInterface;
use PHPAPILibrary\Core\Identity\LoggerInterface;
use PHPAPILibrary\Core\Identity\RateControllerInterface;

/**
 * Default implementation of an AbstractLayerController.
 * Class LayerController
 * @package PHPAPILibrary\Core\Identity\Out
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
    private $networkLayerController;
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
     * @param \PHPAPILibrary\Core\Network\LayerControllerInterface $networkLayerController
     * @param RequestTranslatorInterface $requestTranslator
     * @param ResponseTranslatorInterface $responseTranslator
     */
    public function __construct(
        AccessControllerInterface $accessController,
        RateControllerInterface $rateController,
        CacheControllerInterface $cacheController,
        LoggerInterface $logger,
        \PHPAPILibrary\Core\Network\LayerControllerInterface $networkLayerController,
        RequestTranslatorInterface $requestTranslator,
        ResponseTranslatorInterface $responseTranslator
    )
    {
        $this->accessController = $accessController;
        $this->rateController = $rateController;
        $this->cacheController = $cacheController;
        $this->logger = $logger;
        $this->networkLayerController = $networkLayerController;
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
        return $this->networkLayerController;
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
