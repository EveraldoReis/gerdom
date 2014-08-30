<?php

require dirname(dirname(dirname(dirname(__FILE__)))) . '/libs/FRAPS/Loader.php';
use FRAPS\Router;
use FRAPS\Utils;
use FRAPS\Inflector;

try {
    $router = new Router($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
} catch (Exception $e) {
    echo($e->getMessage());
    //header('Location:' . (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : ROOT_URL));
}