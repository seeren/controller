<?php

/**
 * This file contain Seeren\Controller\ControllerInterface interface
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

use Seeren\Model\ModelInterface;
use Seeren\View\ViewInterface;
/**
 * Interface for represente controller
 * 
 * @category Seeren
 * @package Controller
 */
interface ControllerInterface
{

   /**
    * Call
    *
    * @param string $name method name
    * @param array $arguments method arguments
    * @return null
    *
    * @throws BadMethodCallException
    */
   public function __call(string $name, array $arguments);

   /**
    * Get model
    *
    * @return ModelInterfacemodel
    */
   public function getModel(): ModelInterface;

   /**
    * Get view
    *
    * @return ViewInterface
    */
   public function getView(): ViewInterface;

}
