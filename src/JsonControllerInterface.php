<?php

namespace Seeren\Controller;

use Psr\Http\Message\ResponseInterface;

/**
 * Interface to represent a json controller
 *
 *     __
 *    / /__ __ __ __ __ __
 *   / // // // // // // /
 *  /_// // // // // // /
 *    /_//_//_//_//_//_/
 *
 * @package Seeren\Controller
 */
interface JsonControllerInterface extends ControllerInterface
{

    /**
     * @param $body
     * @param int $status
     * @param array $headers
     * @param int $options
     * @return ResponseInterface
     */
    public function render(
        $body,
        int $status,
        array $headers,
        int $options): ResponseInterface;

}
