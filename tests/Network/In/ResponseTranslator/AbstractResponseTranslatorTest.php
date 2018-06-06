<?php
namespace PHPAPILibrary\Core\Network\In\ResponseTranslator;

use PHPAPILibrary\Core\Network\ResponseInterface as NetworkResponseInterface;
use PHPAPILibrary\Core\Data\ResponseInterface as DataResponseInterface;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\StreamInterface;

class AbstractResponseTranslatorTest extends TestCase
{
    public function testGetsDataTranslatorCallsTranslateAndBuildsResponse() {
        $dataMock = $this->getMockBuilder(StreamInterface::class)->getMock();
        $dataResponseMock = $this->getMockBuilder(DataResponseInterface::class)->getMock();
        $networkResponseMock = $this->getMockBuilder(NetworkResponseInterface::class)->getMock();
        $mockedDataTranslator = $this->getMockBuilder(DataTranslatorInterface::class)->getMock();
        $responseTranslator = $this->getMockForAbstractClass(AbstractResponseTranslator::class);

        $responseTranslator->expects($this->once())->method('getDataTranslator')->with($dataResponseMock)->willReturn($mockedDataTranslator);
        $responseTranslator->expects($this->once())->method('buildResponse')->with($dataMock, $dataResponseMock)->willReturn($networkResponseMock);
        $mockedDataTranslator->expects($this->once())->method('translateData')->with($dataResponseMock)->willReturn($dataMock);

        $this->assertEquals($networkResponseMock, $responseTranslator->translateResponse($dataResponseMock));
    }
}
