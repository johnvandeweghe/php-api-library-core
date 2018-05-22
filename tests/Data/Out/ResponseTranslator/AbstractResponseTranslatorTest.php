<?php
namespace PHPAPILibrary\Core\Data\Out\ResponseTranslator;

use PHPAPILibrary\Core\Data\DataInterface;
use PHPAPILibrary\Core\Data\ResponseInterface as DataResponseInterface;
use PHPAPILibrary\Core\Network\ResponseInterface as NetworkResponseInterface;
use PHPUnit\Framework\TestCase;

class AbstractResponseTranslatorTest extends TestCase
{
    public function testGetsDataTranslatorCallsTranslateAndBuildsResponse() {
        $dataMock = $this->getMockBuilder(DataInterface::class)->getMock();
        $dataResponseMock = $this->getMockBuilder(DataResponseInterface::class)->getMock();
        $networkResponseMock = $this->getMockBuilder(NetworkResponseInterface::class)->getMock();
        $mockedDataTranslator = $this->getMockBuilder(DataTranslatorInterface::class)->getMock();
        $responseTranslator = $this->getMockForAbstractClass(AbstractResponseTranslator::class);

        $responseTranslator->expects($this->once())->method('getDataTranslator')->with($networkResponseMock)->willReturn($mockedDataTranslator);
        $responseTranslator->expects($this->once())->method('buildResponse')->with($dataMock, $networkResponseMock)->willReturn($dataResponseMock);
        $mockedDataTranslator->expects($this->once())->method('translateData')->with($networkResponseMock)->willReturn($dataMock);

        $this->assertEquals($dataResponseMock, $responseTranslator->translateResponse($networkResponseMock));
    }
}
