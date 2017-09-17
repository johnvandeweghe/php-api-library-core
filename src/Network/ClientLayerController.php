<?php
namespace PHPAPILibrary\Core\Network;

use PHPAPILibrary\Core\Network\Exception\RequestException;
use PHPAPILibrary\Core\Network\Exception\UnableToProcessRequestException;

/**
 * Interface ClientLayerController
 * @package PHPAPILibrary\Core\Network
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
}
