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
 * @version 1.0.4
 */

namespace Seeren\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
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
    * @throws RuntimeException on faillure
    */
   public final function execute(): string
    {
       $body = "";
       try {
           try {
               $this->response = $this->response->withHeader(
                   "content-type",
                   $this->view->getContentType($this->request));
               $this->__call($this->request->getAttribute("action", ""));
               $body = $this->view->render();
           } catch (ViewException $e) {
               $this->response = $this->response->withStatus(406);
           }
       } catch (BadMethodCallException $e) {
           $this->response = $this->response->withStatus(405);
       } catch (ModelException $e) {
           $this->response = $this->response->withStatus(404);
       } catch (Throwable $e) {
           $this->response = $this->response->withStatus(500);
           throw new RuntimeException(
               "Can't execute " . static::class
             . ": " . $e->getMessage());
       }
       return $body;
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

}
