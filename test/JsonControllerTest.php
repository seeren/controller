<?php

namespace Seeren\Controller\Test;

use PHPUnit\Framework\TestCase;
use Seeren\Controller\JsonController;
use stdClass;

class JsonControllerTest extends TestCase
{

    public function getMock(): JsonController
    {
        return new JsonController();
    }

    /**
     * @runInSeparateProcess
     * @covers \Seeren\Controller\JsonController::__construct
     * @covers \Seeren\Controller\JsonController::render
     * @covers \Seeren\Controller\Controller::__construct
     * @covers \Seeren\Controller\Controller::send
     */
    public function testRenderString(): void
    {
        $body = '{"foo": "bar"}';
        $this->expectOutputString($body);
        $this->getMock()->render($body);
    }

    /**
     * @runInSeparateProcess
     * @covers \Seeren\Controller\JsonController::__construct
     * @covers \Seeren\Controller\JsonController::render
     * @covers \Seeren\Controller\Controller::__construct
     * @covers \Seeren\Controller\Controller::send
     */
    public function testRenderJSONSerializable(): void
    {
        $serializable = new stdClass();
        $serializable->foo = 'bar';
        $this->expectOutputString(json_encode($serializable));
        $this->getMock()->render($serializable);
    }

}
