<?php
namespace PHPAPILibrary\Core\Network\In\RequestTranslator;

use PHPAPILibrary\Core\Data\DataInterface;
use PHPAPILibrary\Core\Data\IdentityInterface;
use PHPAPILibrary\Core\Data\RequestInterface as DataRequestInterface;
use PHPAPILibrary\Core\Network\RequestInterface as NetworkRequestInterface;
use PHPUnit\Framework\TestCase;

class AbstractRequestTranslatorTest extends TestCase
{
    public function testGetsDataTranslatorCallsTranslateAndBuildsRequest() {
        $dataMock = $this->getMockBuilder(DataInterface::class)->getMock();
        $identityMock = $this->getMockBuilder(IdentityInterface::class)->getMock();
        $dataRequestMock = $this->getMockBuilder(DataRequestInterface::class)->getMock();
        $networkRequestMock = $this->getMockBuilder(NetworkRequestInterface::class)->getMock();
        $mockedDataTranslator = $this->getMockBuilder(DataTranslatorInterface::class)->getMock();
        $mockedIdentityProvider = $this->getMockBuilder(IdentityProviderInterface::class)->getMock();
        $requestTranslator = $this->getMockForAbstractClass(AbstractRequestTranslator::class);

        $requestTranslator->expects($this->once())->method('getIdentityProvider')->with($networkRequestMock)->willReturn($mockedIdentityProvider);
        $requestTranslator->expects($this->once())->method('getDataTranslator')->with($networkRequestMock)->willReturn($mockedDataTranslator);
        $requestTranslator->expects($this->once())->method('buildRequest')->with($identityMock, $dataMock, $networkRequestMock)->willReturn($dataRequestMock);
        $mockedDataTranslator->expects($this->once())->method('translateData')->with($networkRequestMock)->willReturn($dataMock);
        $mockedIdentityProvider->expects($this->once())->method('buildIdentity')->with($networkRequestMock, $dataMock)->willReturn($identityMock);

        $this->assertEquals($dataRequestMock, $requestTranslator->translateRequest($networkRequestMock));
    }
}
