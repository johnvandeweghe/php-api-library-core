<?php
namespace PHPAPILibrary\Core\Data;

/**
 * Class AbstractLambdaLayerController
 * @package PHPAPILibrary\Core\Data
 */
abstract class AbstractLambdaLayerController extends AbstractLayerController
{
    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    protected function getResponse(RequestInterface $request): ResponseInterface
    {
        return call_user_func($this->getCallable($request), $request);
    }

    /**
     * @param RequestInterface $request
     * @return callable function(RequestInterface): ResponseInterface
     */
    abstract protected function getCallable(RequestInterface $request): callable;
}
