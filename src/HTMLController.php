<?php

namespace Seeren\Controller;

use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;
use Seeren\Http\Message\MessageInterface;

class HTMLController extends Controller implements HTMLControllerInterface
{

    private string $includePath;

    public function __construct(string $includePath = null)
    {
        parent::__construct([MessageInterface::HEADER_CONTENT_TYPE => 'text/html; charset=utf-8']);
        $this->includePath = rtrim($includePath ??
            dirname(__FILE__, 5)
            . DIRECTORY_SEPARATOR
            . 'templates'
            . DIRECTORY_SEPARATOR
        );
    }

    public final function render(
        string $template,
        array $vars = [],
        int $status = null,
        array $headers = null): ResponseInterface
    {
        $filename = $this->includePath . $template;
        if (!is_file($filename)) {
            throw new InvalidArgumentException('Template "' . $filename . '" cannot be found');
        }
        foreach ($vars as &$value) {
            $value = filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }
        extract($vars);
        unset($vars);
        ob_start();
        include $filename;
        $body = ob_get_contents();
        ob_end_clean();
        return $this->send($status, $headers, $body);
    }

}
