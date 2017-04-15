<?php

/**
 * This file contain Seeren\Controller\Test\ControllerInterfaceTest class
 *     __
 *    / /__ __ __ __ __ __
 *   / // // // // // // /
 *  /_// // // // // // /
 *    /_//_//_//_//_//_/
 *
 * @copyright (c) Cyril Ichti <consultant@seeren.fr>
 * @link http://www.seeren.fr/ Seeren
 * @version 1.1.0
 */

namespace Seeren\Controller\Test;

use Seeren\Controller\ControllerInterface;

/**
 * Class for test ControllerInterface
 * 
 * @category Seeren
 * @package Controller
 * @subpackage Test
 * @abstract
 */
abstract class ControllerInterfaceTest extends \PHPUnit\Framework\TestCase
{

   /**
    * Get ControllerInterface
    * 
    * @return ControllerInterface controller
    */
   abstract protected function getControllerInterface(): ControllerInterface;

   /**
    * Test ControllerInterface::__call
    * 
    * @expectedException \BadMethodCallException
    */
   public final function testCall()
   {
       $this->getControllerInterface()->foo();
   }

}
