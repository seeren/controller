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

use Seeren\View\ViewInterface;
use Seeren\View\Observer\AbstractSubject;
use Seeren\View\View;

/**
 * Class for represente a controller
 * 
 * @category Seeren
 * @package Controller
 */
class AbstractController extends AbstractSubject
{

   protected

       /**
        * @var ViewInterface
        */
       $view;

   /**
    * @param ViewInterface $view view
    */
   protected function __construct(
       ViewInterface $view = null)
   {
       $this->view = $view ? $view : new View;
   }

   /**
    * {@inheritDoc}
    * @see \Seeren\Controller\ControllerInterface::getView()
    */
   public final function getView(): ViewInterface
   {
       return $this->view;
   }

}
