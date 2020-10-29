<?php

namespace Seeren\Controller\Test;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use Seeren\Controller\Controller;

require __DIR__ . '/context.php';

class ControllerTest extends TestCase
{

    /**
     * @return Controller
     */
    public function getMock(): Controller
    {
        return new Controller('1.1', []);
    }

    /**
     * @covers \Seeren\Controller\Controller::__construct
     * @covers \Seeren\Controller\Controller::getRequest
     */
    public function testGetRequest(): void
    {
        $this->assertInstanceOf(ServerRequestInterface::class, $this->getMock()->getRequest());
    }


    /**
     * @runInSeparateProcess
     * @covers \Seeren\Controller\Controller::__construct
     * @covers \Seeren\Controller\Controller::send
     */
    public function testSendOutput(): void
    {
        $this->expectOutputString("Hello");
        $response = $this->getMock()->send(
            201,
            ["Foo" => "Bar"],
            "Hello"
        );
        $this->assertTrue(
            201 === $response->getStatusCode()
            && "Bar" === $response->getHeaderLine("Foo")
        );
    }

}
