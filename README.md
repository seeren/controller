# controller
 [![Build Status](https://travis-ci.org/seeren/controller.svg?branch=master)](https://travis-ci.org/seeren/controller) [![Coverage Status](https://coveralls.io/repos/github/seeren/controller/badge.svg?branch=master)](https://coveralls.io/github/seeren/controller?branch=master) [![Packagist](https://img.shields.io/packagist/dt/seeren/controller.svg)](https://packagist.org/packages/seeren/controller/stats) [![Codacy Badge](https://api.codacy.com/project/badge/Grade/4a0463fb5a084be5bda68e4e36d7c7ac)](https://www.codacy.com/app/seeren/controller?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=seeren/controller&amp;utm_campaign=Badge_Grade) [![Packagist](https://img.shields.io/packagist/v/seeren/controller.svg)](https://packagist.org/packages/seeren/controller#) [![Packagist](https://img.shields.io/packagist/l/seeren/controller.svg)](LICENSE)

**Manage action for http mesage**

## Features
* Controle http message

## Installation
Require this package with [composer](https://getcomposer.org/)
```
composer require seeren/controller dev-master
```

## Controller Usage

#### `Seeren\Controller\HttpController`
Controllers allow you to build a response and a response body for an http action, for example, the following controller
```php
class MyController extends HttpController
{
    protected function get()
    {
        $this->model->setData("message", "Hello world")->notify();
    }
}
```
Will provoke following response if the value of Accept is application/json with GET method
```
HTTP/1.1 200 OK
Content-Type: application/json
{ "message": "Hello world"}
```
Will provoke following response if the value of Accept is application/xml with GET method
```
HTTP/1.1 200 OK
Content-Type: application/xml
<?xml version="1.0" encoding="UTF-8"?>
<root>
    <message>Hello world</message>
</root>
```
Action is the action attribute of a psr-7 server request, corresponding to the http method or the action input value. Protected method corresponding to an action of a routed controler will be called to construct the response. To see how to route a controller check the [router](https://github.com/seeren/router)

#### Resolve dependencies
Using controllers with [application](https://github.com/seeren/application) or [project](https://github.com/seeren/project) package you can resolve dependencies without using a [service provider](https://github.com/seeren/container). you have to declare your dependencies in the constructor argument. If you use constructor, you have to declare provide a ServerRequest at the parent constructor.
```php
class MyController extends HttpController
{
    public function __construct(ServerRequest $request, JSONView $view)
    {
        parent::__construct($request, $view);
    }
    protected function get ()
    {
        $this->model->setData("message", "Hello world")->notify();
    }
}
```
All dependencies will be resolved deeply and they will be shared, for example il a dependency need ServerRequest at construction, the one resolved in the controller will be injected and shared to all dependencies who need the request.

## Run Unit tests
Install dependencies
```
composer update
```
Run [phpunit](https://phpunit.de/) with [Xdebug](https://xdebug.org/) enabled and [OPcache](http://php.net/manual/fr/book.opcache.php) disabled for coverage
```
./vendor/bin/phpunit
```
## Run Coverage
Install dependencies
```
composer update
```
Run [coveralls](https://coveralls.io/) for check coverage
```
./vendor/bin/coveralls -v
```

##  Contributors
* **Cyril Ichti** - *Initial work* - [seeren](https://github.com/seeren)

## License
This project is licensed under the **MIT License** - see the [license](LICENSE) file for details.