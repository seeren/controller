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
 * @version 1.1.1
 */

namespace Seeren\Controller;

use Seeren\Model\ModelInterface;
use Seeren\View\ViewInterface;
use Seeren\View\Observer\SubjectInterface;

/**
 * Interface for represente controller
 * 
 * @category Seeren
 * @package Controller
 */
interface ControllerInterface extends SubjectInterface
{

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
