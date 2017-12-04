<?php
namespace PHPAPILibrary\Core\Identity\Exception;

use PHPAPILibrary\Core\Identity\ResponseInterface;
use Throwable;

/**
 * Class UnableToProcessRequestException
 * @package PHPAPILibrary\Core\Identity\Exception
 */
class UnableToProcessRequestException extends \Exception
{
    /**
     * @var ResponseInterface
     */
    private $response;

    /**
     * RequestException constructor.
     * @param ResponseInterface $response
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(ResponseInterface $response, $message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->response = $response;
    }

    /**
     * @return ResponseInterface
     */
    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
