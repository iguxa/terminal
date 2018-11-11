<?php
/**
 * Created by PhpStorm.
 * User: iguxa
 * Date: 09.11.18
 * Time: 0:06
 */
require __DIR__.'/../vendor/autoload.php';
use App\Router;

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$c = new Router;
$c->run();