<?php

namespace BugTracker\Util;

class BugString {

    public static function Format(string $string, ...$objects) : string {
        $objectsLength = count($objects);
        for($i = 0; $i < $objectsLength; $i++) {
            //the first curly braces is used for the literal brace in {0}, the second one for curly syntax
            $string = str_replace("{{$i}}", $objects[$i], $string);
        }

        return $string;
    }

    public static function FormatNamedKeys(string $string, string $key, string $value) {
        return str_replace("{{$key}}", $value, $string);
    }

    public static function SanitizeURL(string $url) : string {
        //remove the first slash from the url
        $path = ltrim($url, "/");

        //remove GET from url
        $getPos = strpos($path, "?");

        //if the strpos is not found, false will get returned. Also check for the url being just ?foo=bar
        if($getPos != false || ($getPos != false && $getPos == 0)) { 
            $path = substr($path, 0, $getPos);
        }

        return $path;
    }

}