<?php
namespace PHPAPILibrary\Core\Identity\Out\Exception;

use PHPAPILibrary\Core\Identity\Exception\UnableToProcessRequestException;
use PHPAPILibrary\Core\Identity\Response\Response;

/**
 * Class UnableToTranslateResponseException
 * @package PHPAPILibrary\Core\Identity\Out\Exception
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
