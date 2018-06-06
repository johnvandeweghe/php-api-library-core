<?php
namespace PHPAPILibrary\Core\Network\Router;

use PHPAPILibrary\Core\Network\LayerControllerInterface;
use PHPAPILibrary\Core\Network\RequestInterface;
use PHPUnit\Framework\TestCase;

class RegisteredPathRouterTest extends TestCase
{
    public function testReturnsNullOnUnknownPath()
    {
        $path = "/test/";
        $request = $this->getMockBuilder(RequestInterface::class)->getMock();
        $request->method('getPath')->willReturn($path);

        $pathRouter = new RegisteredPathRouter();

        $this->assertNull($pathRouter->route($request));
    }

    public function testReturnsControllerOnKnownPath()
    {
        $path = "/test/";
        $request = $this->getMockBuilder(RequestInterface::class)->getMock();
        $request->method('getPath')->willReturn($path);
        $layerController = $this->getMockBuilder(LayerControllerInterface::class)->getMock();

        $pathRouter = new RegisteredPathRouter([
            $path => $layerController
        ]);

        $this->assertEquals($layerController, $pathRouter->route($request));
    }

    public function testReturnsNullOnKnownPathWhenInsensativeAndMismatched()
    {
        $path = "/test/";
        $request = $this->getMockBuilder(RequestInterface::class)->getMock();
        $request->method('getPath')->willReturn($path);
        $layerController = $this->getMockBuilder(LayerControllerInterface::class)->getMock();

        $pathRouter = new RegisteredPathRouter([
            strtoupper($path) => $layerController
        ], true);

        $this->assertNull($pathRouter->route($request));
    }

    public function testReturnsControllerOnKnownPathWhenAdded()
    {
        $path = "/test/";
        $request = $this->getMockBuilder(RequestInterface::class)->getMock();
        $request->method('getPath')->willReturn($path);
        $layerController = $this->getMockBuilder(LayerControllerInterface::class)->getMock();

        $pathRouter = new RegisteredPathRouter();
        $pathRouter->addRoute($path, $layerController);

        $this->assertEquals($layerController, $pathRouter->route($request));
    }

    public function testReturnsNullOnKnownPathWhenInsensativeAndMismatchedWhenAdded()
    {
        $path = "/test/";
        $request = $this->getMockBuilder(RequestInterface::class)->getMock();
        $request->method('getPath')->willReturn($path);
        $layerController = $this->getMockBuilder(LayerControllerInterface::class)->getMock();

        $pathRouter = new RegisteredPathRouter([], true);
        $pathRouter->addRoute(strtoupper($path), $layerController);

        $this->assertNull($pathRouter->route($request));
    }

    public function testReturnsSecondControllerOnKnownPathWhenAddedAndReplaced()
    {
        $path = "/test/";
        $request = $this->getMockBuilder(RequestInterface::class)->getMock();
        $request->method('getPath')->willReturn($path);
        $layerController = $this->getMockBuilder(LayerControllerInterface::class)->getMock();
        $layerController2 = $this->getMockBuilder(LayerControllerInterface::class)->getMock();

        $pathRouter = new RegisteredPathRouter();
        $pathRouter->addRoute($path, $layerController);
        $pathRouter->addRoute($path, $layerController2, true);

        $this->assertEquals($layerController2, $pathRouter->route($request));
    }

    public function testReturnsFirstControllerOnKnownPathWhenAddedAndNotReplaced()
    {
        $path = "/test/";
        $request = $this->getMockBuilder(RequestInterface::class)->getMock();
        $request->method('getPath')->willReturn($path);
        $layerController = $this->getMockBuilder(LayerControllerInterface::class)->getMock();
        $layerController2 = $this->getMockBuilder(LayerControllerInterface::class)->getMock();

        $pathRouter = new RegisteredPathRouter();
        $pathRouter->addRoute($path, $layerController);
        $pathRouter->addRoute($path, $layerController2);

        $this->assertEquals($layerController, $pathRouter->route($request));
    }
}
