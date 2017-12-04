<?php
namespace PHPAPILibrary\Core\Network\AccessController;

use PHPAPILibrary\Core\Network\RequestInterface;
use PHPUnit\Framework\TestCase;

class AllowAllAccessControllerTest extends TestCase
{
    public function testAllowAccessReturnsTrue() {
        $mockedRequest = $this->getMockBuilder(RequestInterface::class)->getMock();
        $accessController = new AllowAllAccessController();

        $canAccess = $accessController->canAccess($mockedRequest);

        $this->assertTrue($canAccess);
    }
}
