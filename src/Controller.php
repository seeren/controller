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
 * @link http://www.seeren.fr/ Seeren
 * @version 1.1.1
 */

namespace Seeren\Controller;

use Seeren\Model\ModelInterface;
use Seeren\View\ViewInterface;
use Seeren\View\Observer\AbstractSubject;
use Seeren\View\Observer\ObserverInterface;

/**
 * Class for represente a controller
 * 
 * @category Seeren
 * @package Controller
 * @abstract
 */
abstract class Controller extends AbstractSubject
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
    * Construct Controller
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
    * Attach observer
    *
    * @param ObserverInterface $observer updated on notification
    * @return null
    */
   public final function attach(ObserverInterface $observer)
   {
       if ($observer instanceof ViewInterface) {
           parent::attach($observer);
       }
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
