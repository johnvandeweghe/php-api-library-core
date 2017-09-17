<?php
namespace PHPAPILibrary\Core\Data;

use PHPAPILibrary\Core\Data\Exception\RequestException;
use PHPAPILibrary\Core\Data\Exception\UnableToProcessRequestException;

/**
 * Interface ClientLayerController
 * @package PHPAPILibrary\Core\Data
 */
interface ClientLayerController
{
    /**
     * @param Request $request
     * @return Response
     * @throws RequestException
     * @throws UnableToProcessRequestException
     */
    public function sendRequest(Request $request): Response;

    /**
     * @return \PHPAPILibrary\Core\Identity\ClientLayerController
     */
    public function getIdentityLayer(): \PHPAPILibrary\Core\Identity\ClientLayerController;
}
