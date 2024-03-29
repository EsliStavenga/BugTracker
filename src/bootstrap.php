<?php

namespace BugTracker;

class Bootstrap {

    public static function Register() {
        spl_autoload_register(function ($class) {

            //split the classes by their seperator
            $classSplitBySlash = explode("\\", $class);
            //remove the BugTracker namespace part
            array_shift($classSplitBySlash);
            //glue everything back together
            $classWithNamespace = implode("\\", $classSplitBySlash);

            //import the class, since the namespace should be equal to the path
            include APP_ROOT. $classWithNamespace . '.php';
        });
    }

    public static function RegisterErrorHandler() {
        set_error_handler(function($errno, $errstr, $errfile, $errline, $errcontext) {
            // error was suppressed with the @-operator
            if (0 === error_reporting()) {
                return false;
            }

            throw new \ErrorException($errstr, 0, $errno, $errfile, $errline);
        });
    }


}