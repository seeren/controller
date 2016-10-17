## Seeren\Controller\

Manage controllers and http controllers for components and ressources.

#### Code Example

Typically controller is resolved and prefer to consume ressources with ClientRequest instead of use components.

### Seeren\Controller\HttpController

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

#### Running the tests

Running tests with phpunit in the test folder.

```
$ phpunit test/HttpControllerTest.php
```