<?php

namespace Seeren\Controller;

use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;
use Seeren\Http\Message\MessageInterface;
use Seeren\Http\Response\Response;

/**
 * Class to represent a json controller
 *
 *     __
 *    / /__ __ __ __ __ __
 *   / // // // // // // /
 *  /_// // // // // // /
 *    /_//_//_//_//_//_/
 *
 * @package Seeren\Controller
 */
class JsonController extends Controller implements JsonControllerInterface
{

    /**
     * @param string $version
     */
    public function __construct(string $version = MessageInterface::VERSION_1)
    {
        parent::__construct($version, [
            Response::HEADER_CONTENT_TYPE => 'application/json; charset=utf-8'
        ]);
    }

    /**
     * @param $body
     * @param int|null $status
     * @param array|null $headers
     * @param int $options
     * @return ResponseInterface
     * @throws InvalidArgumentException
     */
    public final function render(
        $body,
        int $status = null,
        array $headers = null,
        int $options = 0): ResponseInterface
    {
        return $this->send($status, $headers, is_string($body) ? $body : json_encode($body, $options));
    }

}
