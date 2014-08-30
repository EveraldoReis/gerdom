<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace FRAPS;

/**
 * Description of Inflector
 *
 * @author webdev
 */
class Inflector
{
    //put your code here
    public static $plural = array(
        '/(al)$/i' => 'ais',
        '/(.o)$/i' => '$1s',
    );
    public static $singular = array(
        '/(.(a|o))s$/i' => '$1',
        '/(.a)s$/i' => '$1',
        '/(.c)oes$/i' => '$1ao',
        '/(.e)ms$/i' => '$1m',
        '/(.age|nt)s$/i' => '$1',
        '/(.(io|te))s$/i' => '$1',
    );

    public static function pluralize($word)
    {
        return preg_replace(array_keys(static::$plural), static::$plural, $word);
    }

    public static function singularize($word)
    {
        return preg_replace(array_keys(static::$singular), static::$singular, $word);
    }
}
