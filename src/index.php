<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

define('APP_ROOT', dirname(__FILE__) . "\\");

require(APP_ROOT . "bootstrap.php");
BugTracker\Bootstrap::register();

use BugTracker\Http\Router\Router;
use BugTracker\Views\Index;

use BugTracker\Data\Database\Database;

$r = new Router();

$d = new Database();


echo $d->GetRawQuery();


Router::registerURL("test/test", new Index());