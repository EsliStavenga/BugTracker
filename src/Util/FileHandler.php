<?php

namespace BugTracker\Util;

class FileHandler
{
    public const TEMPLATES_PATH = APP_ROOT . "Views\\Templates\\";
    public const HEADER_PATH = self::TEMPLATES_PATH . "header.php";
    public const FOOTER_PATH = self::TEMPLATES_PATH . "footer.php";

    /**
     * Load a file's contents
     *
     * @param string $url The path to the file
     * @return string The contents, or an empty string if an error occured
     */
    public static function LoadFile(string $url = "") : string {
        $result = "";
        try {
            $result = @\file_get_contents($url);
        } catch(\ErrorException $e) {

        }

        return $result;
    }

    /**
     * Require a file
     *
     * @param string $url The path to the file
     * @param array [$var] An associative array of variables that should be loaded before requiring the file
     * @return void
     */
    public static function RequireFile(string $path, array $var = []) : void {
        extract($var);
        require $path;
    }

}