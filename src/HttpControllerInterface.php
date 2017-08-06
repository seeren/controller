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
 * @link https://github.com/seeren/controller
 * @version 2.0.1
 */

namespace Seeren\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Seeren\Http\Request\ClientRequestInterface;

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
    * @return string
    *
    * @throws RuntimeException on execution exception or error
    */
   public function execute(): string;

   /**
    * Consume service
    *
    * @param ClientRequestInterface $client request
    * @param string $requestTarget request target
    * @return ServerRequestInterface http response
    * 
    * @throws RuntimeException on unavailable target for context
    */
   public function consume(
       ClientRequestInterface $client,
       string $requestTarget): ResponseInterface;

}
