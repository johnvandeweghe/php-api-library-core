<?php
namespace PHPAPILibrary\Core\Network\Exception;

use PHPAPILibrary\Core\Network\Response;
use Throwable;

class UnableToProcessRequestException extends \Exception
{
    /**
     * @var Response
     */
    private $response;

    /**
     * RequestException constructor.
     * @param Response $response
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(Response $response, $message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->response = $response;
    }

    /**
     * @return Response
     */
    public function getResponse(): Response
    {
        return $this->response;
    }
}
