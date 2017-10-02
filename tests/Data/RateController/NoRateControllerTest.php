<?php
namespace PHPAPILibrary\Core\Data\RateController;

use PHPUnit\Framework\TestCase;

class NoRateControllerTest extends TestCase
{
    public function testIsExceedingLimitReturnsFalse(){
        $mockedRequest = $this->getMockBuilder('\PHPAPILibrary\Core\Data\RequestInterface')->getMock();
        $rateController = new NoRateController();

        $isExceedingLimit = $rateController->isExceedingLimit($mockedRequest);

        $this->assertFalse($isExceedingLimit);
    }
}
