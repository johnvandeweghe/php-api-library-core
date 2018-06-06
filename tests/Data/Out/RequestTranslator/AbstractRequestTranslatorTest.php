<?php
namespace PHPAPILibrary\Core\Data\Out\RequestTranslator;

use PHPAPILibrary\Core\Data\RequestInterface as DataRequestInterface;
use PHPAPILibrary\Core\Network\RequestInterface as NetworkRequestInterface;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\StreamInterface;

class AbstractRequestTranslatorTest extends TestCase
{
    public function testGetsDataTranslatorCallsTranslateAndBuildsRequest() {
        $dataMock = $this->getMockBuilder(StreamInterface::class)->getMock();
        $dataRequestMock = $this->getMockBuilder(DataRequestInterface::class)->getMock();
        $networkRequestMock = $this->getMockBuilder(NetworkRequestInterface::class)->getMock();
        $mockedDataTranslator = $this->getMockBuilder(DataTranslatorInterface::class)->getMock();
        $requestTranslator = $this->getMockForAbstractClass(AbstractRequestTranslator::class);

        $requestTranslator->expects($this->once())->method('getDataTranslator')->with($dataRequestMock)->willReturn($mockedDataTranslator);
        $requestTranslator->expects($this->once())->method('buildRequest')->with($dataMock, $dataRequestMock)->willReturn($networkRequestMock);
        $mockedDataTranslator->expects($this->once())->method('translateData')->with($dataRequestMock)->willReturn($dataMock);

        $this->assertEquals($networkRequestMock, $requestTranslator->translateRequest($dataRequestMock));
    }
}
