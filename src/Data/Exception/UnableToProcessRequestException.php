<?php
namespace PHPAPILibrary\Core\Data\Exception;

use PHPAPILibrary\Core\Data\ResponseInterface;
use Throwable;

/**
 * Class UnableToProcessRequestException
 * @package PHPAPILibrary\Core\Data\Exception
 */
class UnableToProcessRequestException extends \Exception
{
    /**
     * @var ?ResponseInterface
     */
    private $response;

    /**
     * RequestException constructor.
     * @param null|ResponseInterface $response
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(?ResponseInterface $response, $message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->response = $response;
    }

    /**
     * @return null|ResponseInterface
     */
    public function getResponse(): ?ResponseInterface
    {
        return $this->response;
    }
}
