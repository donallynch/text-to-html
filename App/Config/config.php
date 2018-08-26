<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use Pimple\Container;
require '../vendor/autoload.php';

/* Set json header */
header('Content-Type: application/json');

$container = new Container();

$container['textToHtml'] = function ($c) {
    include '../App/Services/TextToHtml.php';
    return new \App\Services\TextToHtml();
};

