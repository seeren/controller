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
 * @version 1.2.1
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
    * Execute controller
    *
    * @return string
    * 
    * @throws RuntimeException on execution exception or error
    */
   public function execute(): string;


   /**
    * Get response
    *
    * @return ServerRequestInterface http response
    */
   public function getResponse(): ResponseInterface;

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
