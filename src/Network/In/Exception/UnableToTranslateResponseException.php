<?php
namespace PHPAPILibrary\Core\Network\In\Exception;

use PHPAPILibrary\Core\Network\Exception\UnableToProcessRequestException;
use PHPAPILibrary\Core\Network\Response\Response;

/**
 * Class UnableToTranslateResponseException
 * @package PHPAPILibrary\Core\Network\In\Exception
 */
class UnableToTranslateResponseException extends UnableToProcessRequestException
{
    /**
     * UnableToTranslateResponseException constructor.
     * @param string $message
     * @param int $code
     * @param null $previous
     */
    public function __construct($message = "", $code = 0, $previous = null)
    {
        parent::__construct(Response::getNullResponse(), $message, $code, $previous);
    }
}
