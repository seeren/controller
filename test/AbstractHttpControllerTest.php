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
 * @version 2.0.1
 */

namespace Seeren\Controller\Test;

use Seeren\Controller\ControllerInterface;
use Seeren\Controller\HttpControllerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
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
    * {@inheritDoc}
    * @see \Seeren\Controller\Test\AbstractControllerTest::getControllerInterface()
    */
   protected function getControllerInterface(): ControllerInterface
   {
       return $this->getHttpControllerInterface();
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
               $controller->getView()
           );
           $controller->execute();
       } catch (RuntimeException $e) {
       }
       $this->assertTrue($controller->getResponse()->getStatusCode() === 405);
   }

}
