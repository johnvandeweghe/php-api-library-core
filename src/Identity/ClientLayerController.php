<?php
namespace PHPAPILibrary\Core\Identity;

use PHPAPILibrary\Core\Identity\Exception\RequestException;
use PHPAPILibrary\Core\Identity\Exception\UnableToProcessRequestException;

/**
 * Interface ClientLayerController
 * @package PHPAPILibrary\Core\Identity
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
     * @return \PHPAPILibrary\Core\Network\ClientLayerController
     */
    public function getNetworkLayer(): \PHPAPILibrary\Core\Network\ClientLayerController;
}
