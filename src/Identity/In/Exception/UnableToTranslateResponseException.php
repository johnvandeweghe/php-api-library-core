<?php
namespace PHPAPILibrary\Core\Identity\In\Exception;

use PHPAPILibrary\Core\Identity\Exception\UnableToProcessRequestException;

/**
 * Class UnableToTranslateResponseException
 * @package PHPAPILibrary\Core\Identity\In\Exception
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
        parent::__construct(null, $message, $code, $previous);
    }
}
