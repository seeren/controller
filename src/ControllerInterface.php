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
    * @return ModelInterface
    */
   public function getModel(): ModelInterface;

   /**
    * Get view
    *
    * @return ViewInterface
    */
   public function getView(): ViewInterface;

}
