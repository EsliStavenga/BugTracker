<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

define('APP_ROOT', dirname(__FILE__) . "\\..\\");

require(APP_ROOT . "bootstrap.php");
BugTracker\Bootstrap::Register();
BugTracker\Bootstrap::RegisterErrorHandler();

require(APP_ROOT . "web.php");

use BugTracker\Http\Router\Router;

use BugTracker\Data\Database\Database;

Router::RegisterRedirect("/test", "/testasd");

$r = new Router();
$d = new Database();

// $_GLOBALS["title"] = "test";

// RequireFile(APP_ROOT . "Views\\Templates\\header.php");

// function RequireFile(string $path, array $var = []) : void {

//     extract($var);

//     require $path;
// }


$r->LoadPage();
$r->ShowPage();
