<?php
namespace PHPAPILibrary\Core\Network;

/**
 * Class AbstractLambdaLayerController
 * @package PHPAPILibrary\Core\Network
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
