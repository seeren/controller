<?php

/**
 * This file contain Seeren\Controller\Test\HttpControllerTest class
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

namespace Seeren\Controller\Test;

use Seeren\Controller\HttpControllerInterface;
use Seeren\Controller\HttpController;
use Seeren\View\Test\MyView;
use Seeren\Model\Model;
use Seeren\Http\Stream\ServerRequestStream;
use Seeren\Http\Uri\ServerRequestUri;
use Seeren\Http\Stream\ServerResponseStream;
use Seeren\Http\Request\ServerRequest;
use Seeren\Http\Response\ServerResponse;
use ReflectionClass;

/**
 * Class for test HttpController
 * 
 * @category Seeren
 * @package Controller
 * @subpackage Test
 */
class HttpControllerTest extends HttpControllerInterfaceTest
{

    /**
     * Get HttpControllerInterface
     *
     * @return HttpControllerInterface http controller
     */
    protected function getHttpControllerInterface(): HttpControllerInterface
    {
        return (new ReflectionClass(HttpController::class))->newInstanceArgs([
                (new ReflectionClass(ServerRequest::class))->newInstanceArgs([
                (new ReflectionClass(ServerRequestStream::class))->newInstanceArgs([]),
                (new ReflectionClass(ServerRequestUri::class))->newInstanceArgs([])
            ]),
                (new ReflectionClass(ServerResponse::class))->newInstanceArgs([
                (new ReflectionClass(ServerResponseStream::class))->newInstanceArgs([])
            ]),
                (new ReflectionClass(Model::class))->newInstanceArgs([]),
                (new ReflectionClass(MyView::class))->newInstanceArgs([])]
        );
    }

}
