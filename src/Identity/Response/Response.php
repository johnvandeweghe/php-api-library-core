<?php
namespace PHPAPILibrary\Core\Identity\Response;

use PHPAPILibrary\Core\CacheControlInterface;
use PHPAPILibrary\Core\Identity\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * Class Response
 * @package PHPAPILibrary\Core\Identity\Response
 */
class Response implements ResponseInterface
{
    /**
     * @var CacheControlInterface
     */
    private $cacheControl;
    /**
     * @var array|object|null
     */
    private $data;

    /**
     * Response constructor.
     * @param CacheControlInterface $cacheControl
     * @param array|object|null $data
     */
    public function __construct(CacheControlInterface $cacheControl, $data)
    {
        $this->cacheControl = $cacheControl;
        $this->data = $data;
    }

    /**
     * @return CacheControlInterface
     */
    public function getCacheControl(): CacheControlInterface
    {
        return $this->cacheControl;
    }

    /**
     * @return array|object|null
     */
    public function getData()
    {
        return $this->data;
    }
}
