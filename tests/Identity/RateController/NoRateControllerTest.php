<?php
namespace PHPAPILibrary\Core\Identity\RateController;

use PHPAPILibrary\Core\Identity\RequestInterface;
use PHPUnit\Framework\TestCase;

class NoRateControllerTest extends TestCase
{
    public function testIsExceedingLimitReturnsFalse(){
        $mockedRequest = $this->getMockBuilder(RequestInterface::class)->getMock();
        $rateController = new NoRateController();

        $isExceedingLimit = $rateController->isExceedingLimit($mockedRequest);

        $this->assertFalse($isExceedingLimit);
    }
}
