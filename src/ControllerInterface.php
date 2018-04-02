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
 * @version 3.0.1
 */

namespace Seeren\Controller;

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
    * Get view
    *
    * @return ViewInterface
    */
   public function getView(): ViewInterface;

}
