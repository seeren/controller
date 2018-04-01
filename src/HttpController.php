<?php

/**
 *     __
 *    / /__ __ __ __ __ __
 *   / // // // // // // /
 *  /_// // // // // // /
 *    /_//_//_//_//_//_/
 *
 * @author (c) Cyril Ichti <consultant@seeren.fr>
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
use Seeren\Model\Exception\ModelException;
use Seeren\View\Exception\ViewException;
use BadMethodCallException;
use RuntimeException;
use Throwable;
use Seeren\Http\Stream\ServerResponseStream;
use Seeren\Model\ModelInterface;
use Seeren\View\ViewInterface;

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
        * @var ServerRequestInterface
        */
       $request,

       /**
        * @var ResponseInterface
        */
       $response;

   /**
    * @param ServerRequestInterface $request http server request
    * @param ViewInterface $view view
    * @param ModelInterface $model model
    */
   public function __construct(
       ServerRequest $request,
       ViewInterface $view = null,
       ModelInterface $model = null)
   {
       parent::__construct($view, $model);
       $this->response = new ServerResponse(new ServerResponseStream);
       $this->request = $request;
   }

   /**
    * {@inheritDoc}
    * @see \Seeren\Controller\HttpControllerInterface::getResponse()
    */
   public final function getResponse(): ResponseInterface
   {
       return $this->response;
   }

   /**
    * {@inheritDoc}
    * @see \Seeren\Controller\HttpControllerInterface::getRequest()
    */
   public final function getRequest(): ServerRequestInterface
   {
       return $this->request;
   }

   /**
    * {@inheritDoc}
    * @see \Seeren\Controller\HttpControllerInterface::execute()
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
    * {@inheritDoc}
    * @see \Seeren\Controller\HttpControllerInterface::consume()
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
