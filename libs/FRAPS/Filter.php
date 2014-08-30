<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace FRAPS;

use FRAPS\Utils;
use FRAPS\Inflector;

/**
 * Description of Filter
 *
 * @author webdev
 */
class Filter
{

    //put your code here
    public static function filter($data, $filterDefinitions)
    {
        array_walk($data, array(__CLASS__, '_filter'), $filterDefinitions);
        return $data;
    }

    private function _filter($item, $key, $dataDefinitions)
    {
        if (!isset($dataDefinitions[$key]['null']) || $dataDefinitions[$key]['null'] === false) {
            if (isset($dataDefinitions[$key])) {
                $filtered = filter_var($item, $dataDefinitions[$key]['filter'], $dataDefinitions[$key]);
                if ($filtered != false || is_numeric($filtered)) {
                    return $filtered;
                } else {
                    throw new \Exception($dataDefinitions[$key]['errorMsg']);
                }
            } else {
                throw new \Exception("Filtro para key <b>$key</b> não existe.");
            }
        }
    }

    public static function getDefaultDataDefinitions()
    {

        return array(
            'name' => array(
                'errorMsg' => 'bla bla bla',
                'filter' => FILTER_SANITIZE_STRING,
                'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH,
                'options' => ''
            ),
            'age' => array(
                'errorMsg' => 'bla bla bla',
                'filter' => FILTER_VALIDATE_INT,
                'flags' => FILTER_REQUIRE_SCALAR,
                'options' => array('min_range' => 16)
            ),
            'labels' => array(
                'errorMsg' => 'bla bla bla',
                'filter' => FILTER_SANITIZE_STRING,
                'flags' => FILTER_REQUIRE_ARRAY,
                'options' => array('min_range' => 1)
            ),
            'info' => array(
                'errorMsg' => 'bla bla bla',
                'filter' => FILTER_SANITIZE_SPECIAL_CHARS,
                'flags' => FILTER_REQUIRE_SCALAR,
                'options' => ''
            ),
            'active' => array(
                'errorMsg' => 'bla bla bla',
                'filter' => FILTER_VALIDATE_BOOLEAN,
                'flags' => FILTER_REQUIRE_SCALAR,
                'options' => ''
            ),
            'photo' => array(
                'errorMsg' => 'bla bla bla',
                'filter' => FILTER_VALIDATE_URL,
                'flags' => FILTER_FLAG_PATH_REQUIRED,
                'options' => ''
            ),
            'price' => array(
                'errorMsg' => 'bla bla bla',
                'filter' => FILTER_VALIDATE_FLOAT,
                'flags' => FILTER_REQUIRE_ARRAY | FILTER_FLAG_ALLOW_THOUSAND,
                'options' => array("decimal" => ',', 'min_range' => 1)
            ),
            'scientific' => array(
                'errorMsg' => 'bla bla bla',
                'filter' => FILTER_VALIDATE_FLOAT,
                'flags' => FILTER_FLAG_ALLOW_SCIENTIFIC,
                'options' => ''
            ),
            'fraction' => array(
                'errorMsg' => 'bla bla bla',
                'filter' => FILTER_VALIDATE_FLOAT,
                'flags' => FILTER_FLAG_ALLOW_FRACTION,
                'options' => ''
            ),
        );
    }

}
