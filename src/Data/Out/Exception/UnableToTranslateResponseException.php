<?php
namespace PHPAPILibrary\Core\Data\Out\Exception;

use PHPAPILibrary\Core\Data\Exception\UnableToProcessRequestException;
use PHPAPILibrary\Core\Data\Response\Response;

/**
 * Class UnableToTranslateResponseException
 * @package PHPAPILibrary\Core\Data\Out\Exception
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
