<?php
spl_autoload_register(function ($class) {
    //split the classes by their seperator
    $classSplitBySlash = explode("\\", $class);
    //remove the BugTracker namespace part
    array_shift($classSplitBySlash);
    //glue everything back together
    $classWithNamespace = implode("\\", $classSplitBySlash);

    //import the class, since the namespace should be equal to the path
    include __DIR__ . '\src\\' . $classWithNamespace . '.php';
});