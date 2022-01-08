<?php

namespace Seeren\Controller;

use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;

interface HTMLControllerInterface extends ControllerInterface
{

    /**
     * @param string $template
     * @param array $vars
     * @param int $status
     * @param array $headers
     * @return ResponseInterface
     *
     * @throws InvalidArgumentException for template not found
     */
    public function render(
        string $template,
        array $vars,
        int $status,
        array $headers): ResponseInterface;

}
