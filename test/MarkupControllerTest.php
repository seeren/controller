<?php

namespace Seeren\Controller\Test;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Seeren\Controller\MarkupController;

class MarkupControllerTest extends TestCase
{

    /**
     * @param bool $provide
     * @return MarkupController
     */
    public function getMock(bool $provide = true): MarkupController
    {
        return new MarkupController($provide ? __DIR__ . '/templates/' : null);
    }

    /**
     * @runInSeparateProcess
     * @covers \Seeren\Controller\MarkupController::__construct
     * @covers \Seeren\Controller\MarkupController::render
     * @covers \Seeren\Controller\Controller::__construct
     * @covers \Seeren\Controller\Controller::send
     */
    public function testRender(): void
    {
        $this->expectOutputString('<h1>&lt;bar&gt;</h1>');
        $this->getMock()->render('foo.html.php', [
            'foo' => '<bar>'
        ]);
    }

    /**
     * @covers \Seeren\Controller\MarkupController::__construct
     * @covers \Seeren\Controller\MarkupController::render
     * @covers \Seeren\Controller\Controller::__construct
     * @covers \Seeren\Controller\Controller::send
     */
    public function testRenderException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->getMock(false)->render('foo.html.php');
    }

}
