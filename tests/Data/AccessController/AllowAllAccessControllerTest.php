<?php
namespace PHPAPILibrary\Core\Data\AccessController;

use PHPUnit\Framework\TestCase;

class AllowAllAccessControllerTest extends TestCase
{
    public function testAllowAccessReturnsTrue() {
        $mockedRequest = $this->getMockBuilder('\PHPAPILibrary\Core\Data\RequestInterface')->getMock();
        $accessController = new AllowAllAccessController();

        $canAccess = $accessController->canAccess($mockedRequest);

        $this->assertTrue($canAccess);
    }
}
