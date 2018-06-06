<?php
namespace PHPAPILibrary\Core\Network\In;

use PHPAPILibrary\Core\Network\AccessControllerInterface;
use PHPAPILibrary\Core\Network\CacheControllerInterface;
use PHPAPILibrary\Core\Network\LoggerInterface;
use PHPAPILibrary\Core\Network\RateControllerInterface;

class LayerControllerTest extends AbstractLayerControllerTest
{
    protected function getLayerController(
        AccessControllerInterface $accessController,
        RateControllerInterface $rateController,
        CacheControllerInterface $cacheController,
        LoggerInterface $logger,
        \PHPAPILibrary\Core\Data\LayerControllerInterface $nextLayerController,
        RequestTranslatorInterface $requestTranslator,
        ResponseTranslatorInterface $responseTranslator
    ): \PHPAPILibrary\Core\Network\LayerControllerInterface {
        return new LayerController(
            $accessController,
            $rateController,
            $cacheController,
            $logger,
            $nextLayerController,
            $requestTranslator,
            $responseTranslator
        );
    }
}
