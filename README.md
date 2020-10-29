# Seeren\Controller

[![Build Status](https://travis-ci.org/seeren/controller.svg?branch=master)](https://travis-ci.org/seeren/controller) [![Coverage Status](https://coveralls.io/repos/github/seeren/controller/badge.svg?branch=master)](https://coveralls.io/github/seeren/controller?branch=master) [![Packagist](https://img.shields.io/packagist/dt/seeren/controller.svg)](https://packagist.org/packages/seeren/controller/stats) [![Codacy Badge](https://api.codacy.com/project/badge/Grade/4a0463fb5a084be5bda68e4e36d7c7ac)](https://www.codacy.com/app/seeren/controller?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=seeren/controller&amp;utm_campaign=Badge_Grade) [![Packagist](https://img.shields.io/packagist/v/seeren/controller.svg)](https://packagist.org/packages/seeren/controller#) [![Packagist](https://img.shields.io/packagist/l/seeren/controller.svg)](LICENSE)

Manage action for http message

## Installation

```bash
composer require seeren/controller
```

## Seeren\Controller\JsonController

Retrieve PSR-7 Response for JSON format

```php
use Seeren\Controller\JsonController;

$controller = new JsonController();
$response = $controller->render(['foo' => 'bar']);
```

## Seeren\Controller\MarkupController

Retrieve PSR-7 Response for HTML and others markup format

```php
use Seeren\Controller\MarkupController;

$controller = new MarkupController();
$response = $controller->render('template.html.php', [
        'title' => 'Hello World'
]);
```

By default, log folder is in `/templates`

```bash
project/
└─ templates/
```

Template use PHP syntax and values are sanitized by default

```php
<h1><?= $title ?></h1>
```

## License

This project is licensed under the MIT License