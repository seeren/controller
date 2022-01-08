<?php

namespace Seeren\Controller;

use Psr\Http\Message\ResponseInterface;

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
