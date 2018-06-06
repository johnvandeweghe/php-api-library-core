<?php
namespace PHPAPILibrary\Core\Network\Router;

use PHPAPILibrary\Core\Network\RequestInterface;
use PHPUnit\Framework\TestCase;

class AbstractPathRouterTest extends TestCase
{
    public function testRouteCallsGetWithPath() {
        $path = "/test/";
        $request = $this->getMockBuilder(RequestInterface::class)->getMock();
        $request->method('getPath')->willReturn($path);

        $pathRouter = $this->getMockForAbstractClass(AbstractPathRouter::class);

        $pathRouter->expects($this->once())->method("getLayerControllerFromPath")->with($path)->willReturn(null);

        $pathRouter->route($request);
    }
}
