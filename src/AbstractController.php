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

use Seeren\Model\Model;
use Seeren\Model\ModelInterface;
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
        * @var ModelInterface
        */
       $model,
       /**
        * @var ViewInterface
        */
       $view;

   /**
    * @param ViewInterface $view view
    * @param ModelInterface $model model
    */
   protected function __construct(
       ViewInterface $view = null,
       ModelInterface $model = null)
   {
       $this->view = $view ? $view : new View;
       if ($model) {
           $this->setModel($model);
       }
   }

   /**
    * @return ModelInterface
    */
   private final function setModel(ModelInterface $model): ModelInterface
   {
       $this->model = $model;
       $this->model->attach($this->view);
       return $model;
   }

   /**
    * {@inheritDoc}
    * @see \Seeren\Controller\ControllerInterface::getModel()
    */
   public final function getModel(): ModelInterface
   {
       return $this->model ? $this->model : $this->setModel(new Model);
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
