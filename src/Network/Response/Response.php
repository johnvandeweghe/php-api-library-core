<?php
namespace PHPAPILibrary\Core\Network\Response;

use PHPAPILibrary\Core\CacheControlInterface;
use PHPAPILibrary\Core\Network\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * Class Response
 * @package PHPAPILibrary\Core\Network\Response
 */
class Response implements ResponseInterface
{
    /**
     * @var CacheControlInterface
     */
    private $cacheControl;
    /**
     * @var null|StreamInterface
     */
    private $stream;

    /**
     * Response constructor.
     * @param CacheControlInterface $cacheControl
     * @param null|StreamInterface $stream
     */
    public function __construct(CacheControlInterface $cacheControl, ?StreamInterface $stream)
    {
        $this->cacheControl = $cacheControl;
        $this->stream = $stream;
    }

    /**
     * @return CacheControlInterface
     */
    public function getCacheControl(): CacheControlInterface
    {
        return $this->cacheControl;
    }

    /**
     * @return StreamInterface|null
     */
    public function getData(): ?StreamInterface
    {
        return $this->stream;
    }
}
