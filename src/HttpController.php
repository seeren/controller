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
 * @version 1.0.1
 */

namespace Seeren\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Seeren\Model\ModelInterface;
use Seeren\View\ViewInterface;
use BadMethodCallException;
use RuntimeException;

/**
 * Class for represente http controller
 * 
 * @category Seeren
 * @package Controller
 */
class HttpController extends Controller
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
    * @throws BadMethodCallException
    * @throws RuntimeExceptionr
    */
   public final function execute(): string
    {
       try {
           $this->__call($this->request->getAttribute("action"));
           return $this->view->render();
       } catch (BadMethodCallException $e) {
           $this->response = $this->response->withStatus(405);
           throw $e;
       } catch (Throwable $e) {
           $this->response = $this->response->withStatus(500);
           throw new RuntimeException(
               "Can't execute " . static::class . ": " . $e->getMessage());
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

}
