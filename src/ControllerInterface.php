<?php

namespace Seeren\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

interface ControllerInterface
{

    /**
     * @return ServerRequestInterface
     */
    public function getRequest(): ServerRequestInterface;

    /**
     * @param int $status
     * @param array $headers
     * @param string $body
     * @return ResponseInterface
     */
    public function send(
        int $status,
        array $headers,
        string $body): ResponseInterface;

}
