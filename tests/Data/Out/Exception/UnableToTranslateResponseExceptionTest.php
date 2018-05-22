<?php
namespace PHPAPILibrary\Core\Data\Out\Exception;

use PHPAPILibrary\Core\Data\Response\Response;
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
