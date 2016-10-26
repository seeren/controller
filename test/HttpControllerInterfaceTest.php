<?php

/**
 * This file contain Seeren\Controller\Test\HttpControllerInterfaceTest class
 *     __
 *    / /__ __ __ __ __ __
 *   / // // // // // // /
 *  /_// // // // // // /
 *    /_//_//_//_//_//_/
 *
 * @copyright (c) Cyril Ichti <consultant@seeren.fr>
 * @link http://www.seeren.fr/ Seeren
 * @version 1.1.1
 */

namespace Seeren\Controller\Test;

use Psr\Http\Message\ResponseInterface;
use Seeren\Controller\ControllerInterface;
use Seeren\Controller\HttpControllerInterface;
use BadMethodCallException;

/**
 * Class for test HttpControllerInterface
 * 
 * @category Seeren
 * @package Controller
 * @subpackage Test
 * @abstract
 */
abstract class HttpControllerInterfaceTest extends ControllerInterfaceTest
{

    /**
     * Get HttpControllerInterface
     *
     * @return HttpControllerInterface http controller
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
    * Test ControllerInterface::execute
    */
   public final function testExecute()
   {
       $controller = $this->getHttpControllerInterface();
       try {
           $controller->execute();
       } catch (BadMethodCallException $e) {
       } finally {
           $this->assertTrue(
               406 === $controller->getResponse()->getStatusCode()
           );
       }
   }

   /**
    * Test HttpControllerInterface::getResponse
    */
   public final function testGetResponse()
   {
       $controller = $this->getHttpControllerInterface();
       $this->assertTrue(
           $controller->getResponse() instanceof ResponseInterface
       );
   }

}
