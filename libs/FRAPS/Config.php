<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (!isset($_SESSION)) {
    session_start();
}

/**
 * Description of Config
 *
 * @author webdev
 */
// URL CONFIG
if (!defined('ROOT_URL')) {
    define('ROOT_URL', '/');
}
// DIRECTORIES CONFIG
if (!defined('DS')) {
    define('DS', '/');
}
if (!defined('ROOT_DIR')) {
    define('ROOT_DIR', dirname(dirname(dirname(__FILE__))));
}
if (!defined('LIBS_DIR')) {
    define('LIBS_DIR', ROOT_DIR . DS . 'libs');
}
if (!defined('APPS_DIR')) {
    define('APPS_DIR', ROOT_DIR . DS . 'apps');
}
if (isset($argc)) {
    if (in_array('--app-name', $argv)) {
        $index = array_search('--app-name', $argv);
        if (isset($argv[$index + 1])) {
            define('APP_DIR', APPS_DIR . DS . str_ireplace('www.', '', $argv[$index + 1]));
        } else {
            exit('Por favor passe o nome do diretório do app: --app-dir [path]');
        }
    }
} else {
    if (!defined('APP_DIR')) {
        define('APP_DIR', APPS_DIR . DS . str_ireplace('www.', '', $_SERVER['SERVER_NAME']));
    }
}
if (!defined('UPLOAD_DIR')) {
    define('UPLOAD_DIR', APP_DIR . DS . 'public' . DS . 'uploads');
}
require_once APP_DIR . DS . 'config.php';
if (!defined('USER_LANGUAGE')) {
    $language = isset($_SESSION['language']) ? $_SESSION['language'] : 'pt';
    if (isset($_GET['language'])) {
        $language = $_GET['language'];
    }
    define('USER_LANGUAGE', $language);
}
