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

namespace Seeren\Controller\Test;

use Seeren\Controller\HttpControllerInterface;
use Seeren\Controller\HttpController;
use Seeren\Container\Container;
use Seeren\Container\Resolver\Constructor\TypeHintingResolver;
use Seeren\Container\Cache\CacheContainer;
use Seeren\Http\Request\ServerRequest;
use Seeren\Http\Stream\ServerRequestStream;
use Seeren\Http\Uri\ServerRequestUri;
use Seeren\View\View;
use Seeren\Model\Model;
use Seeren\Model\Exception\ModelException;
use ReflectionClass;
use RuntimeException;
use Exception;

/**
 * Class for test Controller
 * 
 * @category Seeren
 * @package Controller
 * @subpackage Test
 */
class HttpControllerTest extends AbstractHttpControllerTest
{

   /**
    * {@inheritDoc}
    * @see \Seeren\Controller\Test\AbstractHttpControllerTest::getHttpControllerInterface()
    */
   protected function getHttpControllerInterface(): HttpControllerInterface
   {
       return (new ReflectionClass(HttpController::class))->newInstanceArgs([
           (new ReflectionClass(ServerRequest::class))
           ->newInstanceArgs([
               (new ReflectionClass(ServerRequestStream::class))
               ->newInstanceArgs([]),
               (new ReflectionClass(ServerRequestUri::class))
               ->newInstanceArgs([]),
           ]),
           (new ReflectionClass(View::class))->newInstanceArgs([]),
           (new ReflectionClass(Model::class))->newInstanceArgs([]),
       ]);
   }
   
   /**
    * @return Container
    */
   protected function getContainer(): Container
   {
       return (new ReflectionClass(Container::class))->newInstanceArgs([
           (new ReflectionClass(TypeHintingResolver::class))->newInstanceArgs([]),
           (new ReflectionClass(CacheContainer::class))->newInstanceArgs([]),
       ]);
   }
   
   /**
    * @covers \Seeren\Controller\HttpController::__construct
    * @covers \Seeren\Controller\AbstractController::__construct
    * @expectedException \BadMethodCallException
    */
   public function testCallBadMethodCallException()
   {
       parent::testCallBadMethodCallException();
   }

   /**
    * @covers \Seeren\Controller\HttpController::__construct
    * @covers \Seeren\Controller\AbstractController::__construct
    * @covers \Seeren\Controller\AbstractController::getView
    */
   public function testGetView()
   {
       parent::testGetView();
   }

   /**
    * @covers \Seeren\Controller\HttpController::__construct
    * @covers \Seeren\Controller\AbstractController::__construct
    * @covers \Seeren\Controller\HttpController::getRequest
    */
   public function testGetRequest()
   {
       parent::testGetRequest();
   }

   /**
    * @covers \Seeren\Controller\HttpController::__construct
    * @covers \Seeren\Controller\AbstractController::__construct
    * @covers \Seeren\Controller\HttpController::getResponse
    */
   public function testGetResponse()
   {
       parent::testGetResponse();
   }

   /**
    * @covers \Seeren\Controller\HttpController::__construct
    * @covers \Seeren\Controller\AbstractController::__construct
    * @covers \Seeren\Controller\HttpController::execute
    * @covers \Seeren\Controller\HttpController::getResponse
    */
   public function testExecute406()
   {
       parent::testExecute406();
   }

   /**
    * @covers \Seeren\Controller\HttpController::__construct
    * @covers \Seeren\Controller\AbstractController::__construct
    * @covers \Seeren\Controller\AbstractController::getView
    * @covers \Seeren\Controller\HttpController::execute
    * @covers \Seeren\Controller\HttpController::getRequest
    * @covers \Seeren\Controller\HttpController::getResponse
    */
   public function testExecute405()
   {
       parent::testExecute405();
   }

   /**
    * @covers \Seeren\Controller\HttpController::__construct
    * @covers \Seeren\Controller\AbstractController::__construct
    * @covers \Seeren\Controller\HttpController::execute
    * @covers \Seeren\Controller\HttpController::getResponse
    */
   public function testExecute404()
   {
       try {
           $controller = new DummyHttpController("get");
           $controller->execute();
       } catch (RuntimeException $e) {
       }
       $this->assertTrue($controller->getResponse()->getStatusCode() === 404);
   }

   /**
    * @covers \Seeren\Controller\HttpController::__construct
    * @covers \Seeren\Controller\AbstractController::__construct
    * @covers \Seeren\Controller\HttpController::execute
    * @covers \Seeren\Controller\HttpController::getResponse
    */
   public function testExecute500()
   {
       try {
           $controller = new DummyHttpController("post");
           $controller->execute();
       } catch (RuntimeException $e) {
       }
       $this->assertTrue($controller->getResponse()->getStatusCode() === 500);
   }

   /**
    * @covers \Seeren\Controller\HttpController::__construct
    * @covers \Seeren\Controller\AbstractController::__construct
    * @covers \Seeren\Controller\HttpController::execute
    * @covers \Seeren\Controller\HttpController::getResponse
    */
   public function testExecute()
   {
       $controller = new DummyHttpController("put");
       $controller->execute($this->getContainer());
       $this->assertTrue($controller->getResponse()->getStatusCode() === 200);
   }

}

class DummyHttpController extends HttpController
{

    public function __construct($action = "get")
    {
        parent::__construct(
            (new ServerRequest(new ServerRequestStream, new ServerRequestUri))
            ->withHeader("Accept", "application/json")
            ->withAttribute("action", $action),
            new View
       );
    }

    protected function get()
    {
        throw new ModelException("dumy model exception");
    }

    protected function post()
    {
        throw new Exception;
    }

    protected function put(DummyHttpController $dummy)
    {
    }

}
