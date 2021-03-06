<?php

namespace Seeren\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Interface to represent a controller
 *
 *     __
 *    / /__ __ __ __ __ __
 *   / // // // // // // /
 *  /_// // // // // // /
 *    /_//_//_//_//_//_/
 *
 * @package Seeren\Controller
 */
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
