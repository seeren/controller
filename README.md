# Seeren\\Controller

[![Build](https://app.travis-ci.com/seeren/http.svg?branch=master)](https://app.travis-ci.com/seeren/controller)
[![Require](https://poser.pugx.org/seeren/controller/require/php)](https://packagist.org/packages/seeren/controller)
[![Coverage](https://coveralls.io/repos/github/seeren/error/badge.svg?branch=master)](https://coveralls.io/github/seeren/controller?branch=master)
[![Download](https://img.shields.io/packagist/dt/seeren/controller.svg)](https://packagist.org/packages/seeren/controller/stats)
[![Codacy](https://app.codacy.com/project/badge/Grade/223a23afea38458986edf363e84907e3)](https://www.codacy.com/gh/seeren/controller/dashboard?utm_source=github.com&utm_medium=referral&utm_content=seeren/controller&utm_campaign=Badge_Grade)[![Version](https://img.shields.io/packagist/v/seeren/controller.svg)](https://packagist.org/packages/seeren/controller)

Manage action for http message

## Installation

```bash
composer require seeren/controller
```

* * *

## Seeren\\Controller\\JsonController

Retrieve PSR-7 Response for JSON format

```php
use Seeren\Controller\JsonController;

$controller = new JsonController();
$response = $controller->render(['foo' => 'bar']);
```

* * *

## Seeren\\Controller\\HTMLController

Retrieve PSR-7 Response for HTML format

```php
use Seeren\Controller\HTMLController;

$controller = new HTMLController();
$response = $controller->render('template.html.php', [
    'title' => 'Hello World'
]);
```

By default, templates folder is in `/templates` and include path can be specified at construction

```bash
project/
└─ templates/
```

Template use PHP syntax and values are sanitized by default

```php
<h1><?= $title ?></h1>
```

* * *

## License

This project is licensed under the [MIT](./LICENSE) License
