<?php


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace FRAPS;
require dirname(__FILE__).'/Config.php';

/**
 * Description of Loader
 *
 * @author webdev
 */
class Loader
{
    //put your code here
    public static function init(){
        spl_autoload_register(array(__CLASS__, 'loadLib'));        
        spl_autoload_register(array(__CLASS__, 'loadModel'));        
        spl_autoload_register(array(__CLASS__, 'loadController'));        
    }
    private static function loadModel($class){
        $file = str_replace('\\', '/', MODELS_DIR."/$class.php");
        if(file_exists($file)){
            require $file;
        }
    }
    private static function loadController($class){
        $file = str_replace('\\', '/', CONTROLLERS_DIR."/$class.php");
        if(file_exists($file)){
            require $file;
        }
    }
    private static function loadLib($class){
        $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
        $class = str_replace('_', DIRECTORY_SEPARATOR, $class);
        $file = LIBS_DIR."/$class.php";
        if(file_exists($file)){
            require $file;
        }
    }
}

Loader::init();