<?php
namespace PHPAPILibrary\Core\Data\Out;

use PHPAPILibrary\Core\Data\AccessControllerInterface;
use PHPAPILibrary\Core\Data\CacheControllerInterface;
use PHPAPILibrary\Core\Data\LoggerInterface;
use PHPAPILibrary\Core\Data\RateControllerInterface;

class LayerControllerTest extends AbstractLayerControllerTest
{
    protected function getLayerController(
        AccessControllerInterface $accessController,
        RateControllerInterface $rateController,
        CacheControllerInterface $cacheController,
        LoggerInterface $logger,
        \PHPAPILibrary\Core\Network\LayerControllerInterface $nextLayerController,
        RequestTranslatorInterface $requestTranslator,
        ResponseTranslatorInterface $responseTranslator
    ): \PHPAPILibrary\Core\Data\LayerControllerInterface {
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
