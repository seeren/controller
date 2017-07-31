<?php

/**
 * This file contain Seeren\Controller\Test\AbstractControllerTest class
 *     __
 *    / /__ __ __ __ __ __
 *   / // // // // // // /
 *  /_// // // // // // /
 *    /_//_//_//_//_//_/
 *
 * @copyright (c) Cyril Ichti <consultant@seeren.fr>
 * @link http://www.seeren.fr/ Seeren
 * @version 2.0.1
 */

namespace Seeren\Controller\Test;

use Seeren\Controller\ControllerInterface;
use Seeren\Model\ModelInterface;
use Seeren\View\ViewInterface;

/**
 * Class for test ControllerInterface
 * 
 * @category Seeren
 * @package Controller
 * @subpackage Test
 * @abstract
 */
abstract class AbstractControllerTest extends \PHPUnit\Framework\TestCase
{

   /**
    * Get ControllerInterface
    * 
    * @return ControllerInterface controller
    */
   abstract protected function getControllerInterface(): ControllerInterface;

   /**
    * Test call BadMethodCallException 
    */
   public function testCallBadMethodCallException()
   {
       $this->getControllerInterface()->foo();
   }

   /**
    * Test get model
    */
   public function testGetModel()
   {
       $this->assertTrue(
           $this
           ->getControllerInterface()
           ->getModel() instanceof ModelInterface
       );
   }

   /**
    * Test get view
    */
   public function testGetView()
   {
       $this->assertTrue(
           $this
           ->getControllerInterface()
           ->getView() instanceof ViewInterface
       );
   }

}