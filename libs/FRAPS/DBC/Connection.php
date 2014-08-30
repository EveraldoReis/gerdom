<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace FRAPS\DBC;

use FRAPS\Utils;
use FRAPS\Inflector;

/**
 * Description of Connection
 *
 * @author webdev
 */
class Connection
{

    public static $instance;
    public static $reservedWords = array('default', 'key', 'index', 'foreign', 'count', 'select', 'by', 'sort', 'into', 'insert', 'table', 'databse', 'delete', 'update', 'order', 'description');

    //put your code here
    public static function init()
    {
    //var_dump(\PDO::getAvailableDrivers());
        if (class_exists('PDO') && in_array(DBDRIVER, \PDO::getAvailableDrivers())) {
            if (!self::$instance instanceof PDO) {
                self::$instance = new \PDO(DBDRIVER . '://host=' . DBHOST . ';dbname=' . DBNAME . ';charset=' . DBCHARSET, DBUSER, DBPASS);
            }
            self::$instance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            self::$instance->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
        } else {
            if (!self::$instance instanceof mysqli) {
                self::$instance = new \mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
            }
            self::$instance->set_charset(DBCHARSET);
            self::$instance->select_db(DBNAME);
        }
        // self::$instance->query('SET lc_time_names = "pt_BR", @date_format = "%d/%m/%Y", @datetime_format = "%d/%m/%Y %H:%i:%s"');
        return self::$instance;
    }

    public static function unbind(array $data, $prefix = 'data', $separator = ', ')
    {
        $items = array();
        foreach ($data as $key => $item) {
            if (in_array($key, self::$reservedWords)) {
                $items[] = str_replace(":{$prefix}__", '', $key) . " = $key";
            } else {
                $items[] = str_replace(":{$prefix}_", '', $key) . " = $key";
            }
        }
        return implode($separator, $items);
    }

    public static function bind(array $data, $prefix = 'data', $separator = ', ')
    {
        $items = array();
        foreach ($data as $key => $item) {
            if (in_array($key, self::$reservedWords)) {
                $items[] = "`$key` = :{$prefix}__{$key}";
            } else {
                $items[] = "$key = :{$prefix}_{$key}";
            }
        }
        return implode(" $separator ", $items);
    }

    public static function bindArray(array $data, $prefix = 'data', $separator = ', ')
    {
        $items = array();
        foreach ($data as $key => $item) {
            if (in_array($key, self::$reservedWords)) {
                $items["{$prefix}__{$key}"] = $item;
            } else {
                $items["{$prefix}_{$key}"] = $item;
            }
        }
        return implode(" $separator ", $items);
    }

    public static function getBindedValues(array $data, $prefix = 'data')
    {
        $items = array();
        foreach ($data as $key => $value) {
            if (in_array($key, self::$reservedWords)) {
                $items[":{$prefix}__{$key}"] = $value;
            } else {
                $items[":{$prefix}_{$key}"] = $value;
            }
        }
        return $items;
    }

}