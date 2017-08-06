<?php

/**
 * This file contain Seeren\Controller\Controller class
 *     __
 *    / /__ __ __ __ __ __
 *   / // // // // // // /
 *  /_// // // // // // /
 *    /_//_//_//_//_//_/
 *
 * @copyright (c) Cyril Ichti <consultant@seeren.fr>
 * @link https://github.com/seeren/controller
 * @version 1.0.1
 */

namespace Seeren\Controller;

use Seeren\Model\ModelInterface;
use Seeren\View\ViewInterface;
use Seeren\View\Observer\AbstractSubject;

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
        * @var ModelInterface model
        */
       $model,
       /**
        * @var ViewInterface view
        */
       $view;

   /**
    * Construct AbstractController
    *      
    * @param ModelInterface $model model
    * @param ViewInterface $view view
    * @return null
    */
   protected function __construct(
       ModelInterface $model,
       ViewInterface $view)
   {
       $this->model = $model;
       $this->view = $view;
       $this->model->attach($this->view);
   }

   /**
    * Get model
    *
    * @return ModelInterfacemodel
    */
   public final function getModel(): ModelInterface
   {
       return $this->model;
   }
   
   /**
    * Get view
    *
    * @return ViewInterface
    */
   public final function getView(): ViewInterface
   {
       return $this->view;
   }

}
