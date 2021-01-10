<?php

namespace App\Helpers;

class PathHelper
{
    /**
     * Path builder with slashes validity controlling
     *
     * @param array $parts - parts of the path
     * @param string $filename
     *
     * @return string
     */
    public static function build(array $parts, string $filename = ''): string
    {
        $path = '';

        foreach ($parts as $part) {
            $path .= rtrim($part, '/') . '/';
        }

        if ($filename) {
            $path .= ltrim($filename, '/');
        }

        return $path;
    }
}
