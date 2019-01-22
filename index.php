<?php
require 'vendor/autoload.php';

$router = new \App\Router();

\App\DB::init();

$router->add('/','\App\Controller@index');
$router->add('/addnode','\App\Controller@addNode','POST');
$router->add('/deletenode/:num','\App\Controller@deleteNode');
$router->add('/updatenode/:num','\App\Controller@updateNode','POST');
$router->add('/sortnode','\App\Controller@sortNode');

$router->start();
