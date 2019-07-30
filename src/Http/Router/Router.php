<?php

namespace BugTracker\Http\Router;

use BugTracker\Http\Page;

class Router {

    private static $pages = [];

    public function __construct() {
        //remove the first slash from the url
        $path = ltrim($_SERVER['REQUEST_URI'], "/");
        //replace the slash with a dot for file names
        //$path = str_replace("/", ".", $path);

        //echo $path;
        
    }

    public static function registerURL(string $url, Page $callbackClass) : void {
        self::$pages[$url] = $callbackClass;
    }

}