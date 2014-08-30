<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Config
 *
 * @author webdev
 */
// URL CONFIG
if (!defined('CONTROLLERS_DIR')) {
    define('CONTROLLERS_DIR', APP_DIR . '/controllers');
}
if (!defined('MODELS_DIR')) {
    define('MODELS_DIR', APP_DIR . '/models');
}
if (!defined('VIEWS_DIR')) {
    define('VIEWS_DIR', APP_DIR . '/views');
}
if (!defined('LAYOUTS_DIR')) {
    define('LAYOUTS_DIR', APP_DIR . '/views/layouts');
}
if (!defined('TEMPLATES_DIR')) {
    define('TEMPLATES_DIR', APP_DIR . '/views/templates');
}
if (!defined('ELEMENTS_DIR')) {
    define('ELEMENTS_DIR', APP_DIR . '/views/elements');
}
// DATABASE CONFIG
if (!defined('DBDRIVER')) {
    define('DBDRIVER', 'mysql');
}
if (!defined('DBHOST')) {
    define('DBHOST', 'localhost');
}
if (!defined('DBNAME')) {
    define('DBNAME', '');
}
if (!defined('DBUSER')) {
    define('DBUSER', '');
}
if (!defined('DBPASS')) {
    define('DBPASS', '');
}
if (!defined('DBCHARSET')) {
    define('DBCHARSET', 'utf8');
}
if (!defined('MULTI_LOGIN')) {
    define('MULTI_LOGIN', false);
}
if (!defined('FB_APP_ID')) {
    define('FB_APP_ID', '');
}
if (!defined('FB_APP_SECRET')) {
    define('FB_APP_SECRET', '');    
}
if (!defined('SMTP_SERVER')) {
    define('SMTP_SERVER', '');    
}
if (!defined('SMTP_USER')) {
    define('SMTP_USER', '');    
}
if (!defined('SMTP_PASS')) {
    define('SMTP_PASS', '');    
}
if (!defined('SMTP_HOST')) {
    define('SMTP_HOST', '');    
}

setlocale (LC_TIME , 'pt_BR');
setlocale (LC_MONETARY , 'pt_BR');
setlocale (LC_NUMERIC , 'pt_BR');
