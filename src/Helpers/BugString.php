<?php

namespace BugTracker\Helpers;

class BugString {

    public static function Format(string $string, ...$objects) : string {
        $objectsLength = count($objects);
        for($i = 0; $i < $objectsLength; $i++) {
            //the first curly braces is used for the literal brace in {0}, the second one for curly syntax
            $string = str_replace("{{$i}}", $objects[$i], $string);
        }

        return $string;
    }

}