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

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Seeren\Container\Container;

/**
 * Interface for represente http controller
 * 
 * @category Seeren
 * @package Controller
 */
interface HttpControllerInterface extends ControllerInterface
{

   /**
    * Get response
    *
    * @return ResponseInterface http response
    */
   public function getResponse(): ResponseInterface;

   /**
    * Get request
    *
    * @return ServerRequestInterface http request
    */
   public function getRequest(): ServerRequestInterface;

   /**
    * Execute controller
    *
    * @param \Seeren\Container\Container $container
    * 
    * @return string
    *
    * @throws \RuntimeException on execution exception or error
    */
   public function execute(Container $container = null): string;

}
