<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace FRAPS;

/**
 * Description of Router
 *
 * @author webdev
 */
class Router extends \RecursiveArrayIterator
{

    //put your code here
    public function __construct($url, $method)
    {
        $method = 'FRAPS\Network\\'.strtoupper($method);
        $request = new $method($url);
        $request->renderView();
    }

}
