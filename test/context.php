<?php

namespace Seeren\Http\Uri;

/**
 * @param int $type
 * @param string $key
 * @param int|null $flag
 * @param array|null $options
 * @return mixed
 */
function filter_input(
    int $type,
    string $key,
    int $flag = null,
    array $options = null)
{
    static $called = 0;
    if (5 === $type) {
        if ('REQUEST_SCHEME' === $key) {
            return 'http';
        } elseif ('SERVER_NAME' === $key) {
            return 'host';
        } elseif ($called === 0 && 'PATH_INFO' === $key) {
            $called++;
            return 'info';
        } elseif ($called === 1 && 'REDIRECT_URL' === $key) {
            $called++;
            return 'redirect';
        } elseif ('REQUEST_URI' === $key) {
            return 'path';
        }
    }
    return \filter_input($type, $key, $flag, $options);
}
