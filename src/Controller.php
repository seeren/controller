<?php

namespace Seeren\Controller;

use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Seeren\Http\Request\Request;
use Seeren\Http\Response\Response;
use Seeren\Http\Stream\RequestStream;
use Seeren\Http\Stream\ResponseStream;
use Seeren\Http\Uri\RequestUri;

/**
 * Class to represent a controller
 *
 *     __
 *    / /__ __ __ __ __ __
 *   / // // // // // // /
 *  /_// // // // // // /
 *    /_//_//_//_//_//_/
 *
 * @package Seeren\Controller
 */
class Controller implements ControllerInterface
{

    /**
     * @var ServerRequestInterface
     */
    private ServerRequestInterface $request;

    /**
     * @var ResponseInterface
     */
    private ResponseInterface $response;

    /**
     * @param string $version
     * @param array $headers
     */
    public function __construct(string $version, array $headers)
    {
        $this->request = new Request(new RequestStream(), new RequestUri());
        $this->response = new Response(new ResponseStream(), $headers, $version);
    }

    /**
     * @return ServerRequestInterface
     */
    public final function getRequest(): ServerRequestInterface
    {
        return $this->request;
    }

    /**
     * @param int|null $status
     * @param array|null $headers
     * @param string|null $body
     * @return ResponseInterface
     * @throws InvalidArgumentException
     */
    public final function send(
        int $status = null,
        array $headers = null,
        string $body = null): ResponseInterface
    {
        if ($status) {
            $this->response = $this->response->withStatus($status);
        }
        if ($headers) {
            foreach ($headers as $key => $value) {
                $this->response = $this->response->withAddedHeader($key, $value);
            }
        }
        header(
            'HTTP/'
            . $this->response->getProtocolVersion()
            . ' '
            . $this->response->getStatusCode()
            . ' '
            . $this->response->getReasonPhrase()
        );
        foreach ($this->response->getHeaders() as $key => $value) {
            header($key . ': ' . implode(';', $value));
        }
        if ($body) {
            $this->response->getBody()->write($body);
        }
        return $this->response;
    }

}
