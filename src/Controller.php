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
 * @version 1.0.1
 */

namespace Seeren\Controller;

use Seeren\Model\ModelInterface;
use Seeren\View\ViewInterface;
use ReflectionMethod;
use BadMethodCallException;

/**
 * Class for represente a controller
 * 
 * @category Seeren
 * @package Controller
 * @abstract
 */
abstract class Controller
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
   public function __construct(
       ModelInterface $model,
       ViewInterface $view)
   {
       $this->model = $model;
       $this->view = $view;
       $this->model->attach($this->view);
   }

   /**
    * Call
    *
    * @param string $name method name
    * @param array $arguments method arguments
    * @return null
    *
    * @throws BadMethodCallException if method not exists|not protected
    */
   public function __call(string $name, array $arguments = [])
   {
       if (!method_exists($this, $name)) {
           throw new BadMethodCallException(
               "Can't call " . static::class . "::" . $name
             . " do not exists");
       }
       if (!(new ReflectionMethod($this, $name))->isProtected()) {
           throw new BadMethodCallException(
               "Can't call " . static::class . "::" . $name
             . " must be protected");
       }
       $this->{$name}(...$arguments);
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
