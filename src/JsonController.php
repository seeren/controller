<?php

namespace Seeren\Controller;

use Psr\Http\Message\ResponseInterface;
use Seeren\Http\Message\MessageInterface;

class JsonController extends Controller implements JsonControllerInterface
{

    public function __construct()
    {
        parent::__construct([
            MessageInterface::HEADER_CONTENT_TYPE => 'application/json; charset=utf-8'
        ]);
    }

    public final function render(
        $body,
        int $status = null,
        array $headers = null,
        int $options = 0): ResponseInterface
    {
        return $this->send($status, $headers, is_string($body) ? $body : json_encode($body, $options));
    }

}
