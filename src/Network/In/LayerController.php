<?php
namespace PHPAPILibrary\Core\Network\In;

use PHPAPILibrary\Core\Network\AccessControllerInterface;
use PHPAPILibrary\Core\Network\CacheControllerInterface;
use PHPAPILibrary\Core\Network\LoggerInterface;
use PHPAPILibrary\Core\Network\RateControllerInterface;

/**
 * Default implementation of an AbstractLayerController.
 * Class LayerController
 * @package PHPAPILibrary\Core\Network\In
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
    private $identityLayerController;
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
     * @param \PHPAPILibrary\Core\Data\LayerControllerInterface $identityLayerController
     * @param RequestTranslatorInterface $requestTranslator
     * @param ResponseTranslatorInterface $responseTranslator
     */
    public function __construct(
        AccessControllerInterface $accessController,
        RateControllerInterface $rateController,
        CacheControllerInterface $cacheController,
        LoggerInterface $logger,
        \PHPAPILibrary\Core\Data\LayerControllerInterface $identityLayerController,
        RequestTranslatorInterface $requestTranslator,
        ResponseTranslatorInterface $responseTranslator
    )
    {
        $this->accessController = $accessController;
        $this->rateController = $rateController;
        $this->cacheController = $cacheController;
        $this->logger = $logger;
        $this->identityLayerController = $identityLayerController;
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
     * @return \PHPAPILibrary\Core\Data\LayerControllerInterface
     */
    protected function getNextLayer(): \PHPAPILibrary\Core\Data\LayerControllerInterface
    {
        return $this->identityLayerController;
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
