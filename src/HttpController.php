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
 * @link http://www.seeren.fr/ Seeren
 * @version 1.2.1
 */

namespace Seeren\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Seeren\Http\Response\Response;
use Seeren\Http\Request\ClientRequestInterface;
use Seeren\Model\ModelInterface;
use Seeren\View\ViewInterface;
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
class HttpController extends Controller implements HttpControllerInterface
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
       ServerRequestInterface $request,
       ResponseInterface $response,
       ModelInterface $model,
       ViewInterface $view)
   {
       parent::__construct($model, $view);
       $this->request = $request;
       $this->response = $response;
   }

   /**
    * Execute controller
    *
    * @return string
    * 
    * @throws RuntimeException on execution exception or error
    */
   public final function execute(): string
    {
       try {
           $this->response = $this->response->withHeader(
               Response::HEADER_CONTENT_TYPE,
               $this->view->getContentType($this->request));
           $this->__call($this->request->getAttribute("action"));
           return $this->view->render();
       } catch (Throwable $e) {
           if ($e instanceof ViewException) {
               $this->response = $this->response->withStatus(406);
           } else if ($e instanceof BadMethodCallException) {
               $this->response = $this->response->withStatus(405);
           } else if ($e instanceof ModelException) {
               $this->response = $this->response->withStatus(404);
           } else {
               $this->response = $this->response->withStatus(500);
           }
           throw new RuntimeException(
               "Can't execute " . static::class . ": " .$e->getMessage());
       }
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
           return $client
           ->withRequestTarget($requestTarget)
           ->send()
           ->getResponse();
       } catch (RuntimeException $e) {
           throw new RuntimeException(
               "Can't " . static::class . ":consume "
             . $requestTarget . ": " . $e->getMessage());
       }
    }

}
