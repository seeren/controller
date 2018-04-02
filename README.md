# controller
 [![Build Status](https://travis-ci.org/seeren/controller.svg?branch=master)](https://travis-ci.org/seeren/controller) [![Coverage Status](https://coveralls.io/repos/github/seeren/controller/badge.svg?branch=master)](https://coveralls.io/github/seeren/controller?branch=master) [![Packagist](https://img.shields.io/packagist/dt/seeren/controller.svg)](https://packagist.org/packages/seeren/controller/stats) [![Codacy Badge](https://api.codacy.com/project/badge/Grade/4a0463fb5a084be5bda68e4e36d7c7ac)](https://www.codacy.com/app/seeren/controller?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=seeren/controller&amp;utm_campaign=Badge_Grade) [![Packagist](https://img.shields.io/packagist/v/seeren/controller.svg)](https://packagist.org/packages/seeren/controller#) [![Packagist](https://img.shields.io/packagist/l/seeren/controller.svg)](LICENSE)

**Manage action for http mesage**

## Features
* Build response view

## Installation
Require this package with [composer](https://getcomposer.org/)
```
composer require seeren/controller dev-master
```

## Usage

#### `Seeren\Controller\HttpController`
Create http controller and actions
```php
class Controller extends HttpController
{
    public function get(Model $model)
    {
        $this->getView()->update(
            $model->setData("message", "Hello world")
        );
    }
}
```
Controller build views
```
HTTP/1.1 200 OK
Content-Type: application/json
{ "message": "Hello world"}
```
```
HTTP/1.1 200 OK
Content-Type: application/xml
<?xml version="1.0" encoding="UTF-8"?>
<root>
    <message>Hello world</message>
</root>
```

See [how to route a controller](https://github.com/seeren/router)

## Run Tests
Run [phpunit](https://phpunit.de/) with [Xdebug](https://xdebug.org/) enable and [OPcache](http://php.net/manual/fr/book.opcache.php) disable
```
./vendor/bin/phpunit
```

## Run Coverage
Run [coveralls](https://coveralls.io/)
```
./vendor/bin/php-coveralls -v
```


## License
This project is licensed under the **MIT License** - see the [license](LICENSE) file for details.