<?php

/**
 * This file contain Seeren\Controller\HttpControllerInterface interface
 *     __
 *    / /__ __ __ __ __ __
 *   / // // // // // // /
 *  /_// // // // // // /
 *    /_//_//_//_//_//_/
 *
 * @copyright (c) Cyril Ichti <consultant@seeren.fr>
 * @link http://www.seeren.fr/ Seeren
 * @version 1.1.2
 */

namespace Seeren\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Interface for represente http controller
 * 
 * @category Seeren
 * @package Controller
 */
interface HttpControllerInterface extends ControllerInterface
{

    /**
     * Execute controller
     *
     * @return string
     */
    public function execute(): string;

   /**
    * Get response
    *
    * @return ServerRequestInterface http response
    */
   public function getResponse(): ResponseInterface;

}
