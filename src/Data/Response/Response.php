<?php
namespace PHPAPILibrary\Core\Data\Response;

use PHPAPILibrary\Core\CacheControl\NoCacheControl;
use PHPAPILibrary\Core\CacheControlInterface;
use PHPAPILibrary\Core\Data\DataInterface;
use PHPAPILibrary\Core\Data\ResponseInterface;

/**
 * Class Response
 * @package PHPAPILibrary\Core\Data\Response
 */
class Response implements ResponseInterface
{
    /**
     * @var CacheControlInterface
     */
    private $cacheControl;
    /**
     * @var DataInterface|null
     */
    private $data;

    /**
     * Response constructor.
     * @param CacheControlInterface $cacheControl
     * @param DataInterface|null $data
     */
    public function __construct(CacheControlInterface $cacheControl, ?DataInterface $data)
    {
        $this->cacheControl = $cacheControl;
        $this->data = $data;
    }

    /**
     * Get an empty response.
     * @return Response
     */
    public static function getNullResponse(): Response {
        return new Response(new NoCacheControl(), null);
    }

    /**
     * @return CacheControlInterface
     */
    public function getCacheControl(): CacheControlInterface
    {
        return $this->cacheControl;
    }

    /**
     * @return DataInterface|null
     */
    public function getData(): ?DataInterface
    {
        return $this->data;
    }
}
