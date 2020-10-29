<?php

namespace Seeren\Controller;

use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;
use Seeren\Http\Message\MessageInterface;
use Seeren\Http\Response\Response;

/**
 * Class to represent a markup controller
 *
 *     __
 *    / /__ __ __ __ __ __
 *   / // // // // // // /
 *  /_// // // // // // /
 *    /_//_//_//_//_//_/
 *
 * @package Seeren\Controller
 */
class MarkupController extends Controller implements MarkupControllerInterface
{

    /**
     * @var string
     */
    private string $includePath;

    /**
     * @param string|null $includePath
     * @param string $charset
     * @param string $version
     */
    public function __construct(
        string $includePath = null,
        string $charset = 'text/html; charset=utf-8',
        string $version = MessageInterface::VERSION_1)
    {
        parent::__construct($version, [Response::HEADER_CONTENT_TYPE => $charset]);
        $this->includePath = rtrim($includePath ??
            dirname(__FILE__, 5)
            . DIRECTORY_SEPARATOR
            . 'templates'
            . DIRECTORY_SEPARATOR
        );
    }

    /**
     * @param string $template
     * @param array|null $vars
     * @param int|null $status
     * @param array|null $headers
     * @return ResponseInterface
     * @throws InvalidArgumentException
     */
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
