[![Codacy Badge](https://api.codacy.com/project/badge/Grade/a0877c06a743415fa2efed9f163e5182)](https://www.codacy.com/app/seeren/controller?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=seeren/controller&amp;utm_campaign=Badge_Grade) [![Build Status](https://travis-ci.org/seeren/controller.svg?branch=master)](https://travis-ci.org/seeren/controller) [![GitHub license](https://img.shields.io/badge/license-MIT-orange.svg)](https://raw.githubusercontent.com/seeren/controller/master/LICENSE) [![Packagist](https://img.shields.io/packagist/v/seeren/controller.svg)](https://packagist.org/packages/seeren/controller#v1.2.7) [![Packagist](https://img.shields.io/packagist/dt/seeren/controller.svg)](https://packagist.org/packages/seeren/controller/stats)

# Seeren\Controller\
Manage controllers and http controllers for components and ressources.
Typically controller is resolved and prefer to consume ressources with ClientRequest instead of use components.

## Seeren\Controller\HttpController
Controllers have to be buisness specifique. HttpController expect a psr-7 implementation of ServerRequestInterface and ResponseInterface at construction.
```php
$controller = new HttpController(
        new ServerRequest(new ServerRequestStream, new ServerRequestUri),
        new Response(new ServerResponseStream),
        new Model,
        new View);
```
They have to be dispatched and their construction resolved.
```php
$controller = $container->get("mycontroller");
```
Http controllers can only be executed for Request::getAttribute value of action attribute.
```php
try {
    $controller->getResponse()
               ->getBody()
               ->write($controller->execute());
} catch (BadMethodCallException $e) {
    header("HTTP/1.1 "
         . $controller->getResponse()->getStatusCode(). " "
         . $controller->getResponse()->getReasonPhrase());
}
```

## Installation
Require this package with composer
```
composer require seeren/controller dev-master
```

## Run the tests
Run with phpunit after install dependencies
```
composer update
phpunit
```

## Authors
* **Cyril Ichti** - [www.seeren.fr](http://www.seeren.fr)