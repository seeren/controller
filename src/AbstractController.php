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
 * @version 1.1.1
 */

namespace Seeren\Controller;

use Seeren\Model\ModelInterface;
use Seeren\View\ViewInterface;
use Seeren\View\Observer\AbstractSubject;
use Seeren\Model\Model;

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
    * @param ViewInterface $view view
    * @param ModelInterface $model model
    * @return null
    */
   protected function __construct(
       ViewInterface $view,
       ModelInterface $model = null)
   {
       $this->view = $view;
       if ($model) {
           $this->setModel($model);
       }
   }

   /**
    * Set model
    *
    * @return ModelInterfacemodel
    */
   private final function setModel(ModelInterface $model): ModelInterface
   {
       $this->model = $model;
       $this->model->attach($this->view);
       return $model;
   }

   /**
    * Get model
    *
    * @return ModelInterfacemodel
    */
   public final function getModel(): ModelInterface
   {
       return $this->model ? $this->model : $this->setModel(new Model);
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
