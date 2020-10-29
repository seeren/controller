<?php

namespace Seeren\Controller;

use Psr\Http\Message\ResponseInterface;

/**
 * Interface to represent a markup controller
 *
 *     __
 *    / /__ __ __ __ __ __
 *   / // // // // // // /
 *  /_// // // // // // /
 *    /_//_//_//_//_//_/
 *
 * @package Seeren\Controller
 */
interface MarkupControllerInterface extends ControllerInterface
{

    /**
     * @param string $template
     * @param array $vars
     * @param int $status
     * @param array $headers
     * @return ResponseInterface
     */
    public function render(
        string $template,
        array $vars,
        int $status,
        array $headers): ResponseInterface;

}
