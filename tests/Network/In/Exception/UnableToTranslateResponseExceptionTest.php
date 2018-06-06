<?php
namespace PHPAPILibrary\Core\Network\In\Exception;

use PHPAPILibrary\Core\Network\Response\Response;
use PHPUnit\Framework\TestCase;

class UnableToTranslateResponseExceptionTest extends TestCase
{
    public function testConstructorSetsParentFields() {
        $message = "test message";
        $code = 123;
        $previous = new \Exception();

        $exception = new UnableToTranslateResponseException($message, $code, $previous);

        $this->assertEquals($message, $exception->getMessage());
        $this->assertEquals($code, $exception->getCode());
        $this->assertEquals($previous, $exception->getPrevious());
    }

    public function testConstructorBuildsNullResponse() {
        $exception = new UnableToTranslateResponseException();

        $this->assertInstanceOf(Response::class, $exception->getResponse());
    }
}


