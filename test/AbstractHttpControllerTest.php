<?php

/**
 * This file contain Seeren\Controller\Test\AbstractHttpControllerTest class
 *     __
 *    / /__ __ __ __ __ __
 *   / // // // // // // /
 *  /_// // // // // // /
 *    /_//_//_//_//_//_/
 *
 * @copyright (c) Cyril Ichti <consultant@seeren.fr>
 * @link https://github.com/seeren/controller
 * @version 2.0.1
 */

namespace Seeren\Controller\Test;

use Seeren\Controller\ControllerInterface;
use Seeren\Controller\HttpControllerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Seeren\Http\Request\ClientRequest;
use Seeren\Http\Uri\Uri;
use Seeren\Http\Request\ClientRequestInterface;
use ReflectionClass;
use RuntimeException;

/**
 * Class for test HttpControllerInterface
 * 
 * @category Seeren
 * @package Controller
 * @subpackage Test
 * @abstract
 */
abstract class AbstractHttpControllerTest extends AbstractControllerTest
{

   /**
    * Get HttpControllerInterface
    * 
    * @return HttpControllerInterface controller
    */
   abstract protected function getHttpControllerInterface(): HttpControllerInterface;

   /**
    * Get ControllerInterface
    *
    * @return ControllerInterface controller
    */
   protected function getControllerInterface(): ControllerInterface
   {
       return $this->getHttpControllerInterface();
   }

   /**
    * Get ClientRequestInterface
    *
    * @return ClientRequestInterface request
    */
   protected function getClientRequest(): ClientRequestInterface
   {
       return (new ReflectionClass(ClientRequest::class))
       ->newInstanceArgs([
           "GET",
           (new ReflectionClass(Uri::class))
           ->newInstanceArgs(["https", "github.com"])
       ]);
   }

   /**
    * Test get request
    */
   public function testGetRequest()
   {
       $this->assertTrue(
           $this
           ->getHttpControllerInterface()
           ->getRequest() instanceof ServerRequestInterface
       );
   }

   /**
    * Test get response
    */
   public function testGetResponse()
   {
       $this->assertTrue(
           $this
           ->getHttpControllerInterface()
           ->getResponse() instanceof ResponseInterface
       );
   }

   /**
    * Test execute 406
    */
   public function testExecute406()
   {
       try {
           $controller = $this->getHttpControllerInterface();
           $controller->execute();
       } catch (RuntimeException $e) {
       }
       $this->assertTrue($controller->getResponse()->getStatusCode() === 406);
   }

   /**
    * Test execute 405
    */
   public function testExecute405()
   {
       try {
           $controller = $this->getHttpControllerInterface();
           $request = $controller
           ->getRequest()
           ->withHeader("Accept", "application/json");
           $controller->__construct(
               $request,
               $controller->getView(),
               $controller->getModel()
           );
           $controller->execute();
       } catch (RuntimeException $e) {
       }
       $this->assertTrue($controller->getResponse()->getStatusCode() === 405);
   }

   /**
    * Test consume
    */
   public function testConsume()
   {
       $this->assertTrue(
           $this->getHttpControllerInterface()->consume(
               $this->getClientRequest(),
               "seeren"
           ) instanceof ResponseInterface
       );
   }

   /**
    * Test consume RuntimeException
    */
   public function testConsumeRuntimeException()
   {
       $this->getHttpControllerInterface()->consume(
           $this->getClientRequest(),
           "bar target"
       );
   }

}
