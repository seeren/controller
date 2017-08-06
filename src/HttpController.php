<?php

/**
 * This file contain Seeren\Controller\HttpController class
 *     __
 *    / /__ __ __ __ __ __
 *   / // // // // // // /
 *  /_// // // // // // /
 *    /_//_//_//_//_//_/
 *
 * @copyright (c) Cyril Ichti <consultant@seeren.fr>
 * @link https://github.com/seeren/controller
 * @version 1.2.3
 */

namespace Seeren\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Seeren\Http\Request\ClientRequestInterface;
use Seeren\Http\Request\ServerRequest;
use Seeren\Http\Response\Response;
use Seeren\Http\Response\ServerResponse;
use Seeren\Model\Model;
use Seeren\View\View;
use Seeren\Model\Exception\ModelException;
use Seeren\View\Exception\ViewException;
use BadMethodCallException;
use RuntimeException;
use Throwable;

/**
 * Class for represente http controller
 * 
 * @category Seeren
 * @package Controller
 */
class HttpController extends AbstractController implements HttpControllerInterface
{

   protected
       /**
        * @var ServerRequestInterface http server request
        */
       $request,
       /**
        * @var ResponseInterface http response
        */
       $response;

   /**
    * Construct HttpController
    *
    * @param ServerRequestInterface $request http server request
    * @param ResponseInterface $response http response
    * @param ModelInterface $model model
    * @param ViewInterface $view view
    * @return null
    */
   public function __construct(
       ServerRequest $request,
       ServerResponse $response,
       Model $model,
       View $view)
   {
       parent::__construct($model, $view);
       $this->request = $request;
       $this->response = $response;
   }

   /**
    * Get response
    *
    * @return ServerRequestInterface http response
    */
   public final function getResponse(): ResponseInterface
   {
       return $this->response;
   }

   /**
    * Get request
    *
    * @return ServerRequestInterface http request
    */
   public final function getRequest(): ServerRequestInterface
   {
       return $this->request;
   }

   /**
    * Execute controller
    *
    * @return string
    * 
    * @throws RuntimeException on execution exception or error
    */
   public function execute(): string
    {
       try {
           $this->response = $this->response->withHeader(
               Response::HEADER_CONTENT_TYPE,
               $this->view->getContentType($this->request));
           $this->__call($this->request->getAttribute("action", ""));
           return $this->view->render();
       } catch (Throwable $e) {
           $this->response = $e instanceof ViewException
                           ? $this->response->withStatus(406)
                           : ($e instanceof BadMethodCallException
                           ? $this->response->withStatus(405)
                           : ($e instanceof ModelException
                           ? $this->response->withStatus(404)
                           : $this->response->withStatus(500)));
           throw new RuntimeException(
               "Can't execute " . static::class . ": " .$e->getMessage());
       }
    }

   /**
    * Consume service
    *
    * @param ClientRequestInterface $client request
    * @param string $requestTarget request target
    * @return ServerRequestInterface http response
    * 
    * @throws RuntimeException on unavailable target for context
    */
   public function consume(
       ClientRequestInterface $client,
       string $requestTarget): ResponseInterface
    {
       try {
           return $client->withRequestTarget($requestTarget)->getResponse();
       } catch (Throwable $e) {
           throw new RuntimeException(
               "Can't " . static::class . ":consume "
             . $requestTarget . ": " . $e->getMessage());
       }
    }

}
