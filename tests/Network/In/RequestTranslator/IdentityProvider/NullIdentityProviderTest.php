<?php
namespace PHPAPILibrary\Core\Network\In\RequestTranslator\IdentityProvider;

use PHPAPILibrary\Core\Data\DataInterface;
use PHPAPILibrary\Core\Network\RequestInterface;
use PHPUnit\Framework\TestCase;

class NullIdentityProviderTest extends TestCase
{
    public function testReturnsNull() {
        $mockedRequest = $this->getMockBuilder(RequestInterface::class)->getMock();
        $mockedData = $this->getMockBuilder(DataInterface::class)->getMock();
        $identityProvider = new NullIdentityProvider();

        $this->assertNull($identityProvider->buildIdentity($mockedRequest, $mockedData));
    }
}
