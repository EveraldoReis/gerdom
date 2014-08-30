<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace FRAPS\Network;

/**
 * Description of GET
 *
 * @author webdev
 */
class GET extends AbstractRequest
{

    //put your code here
    public $data = array();

    public function data($key = false)
    {
        if ($key) {
            $this->data["$key"] = $_GET[$key];
        } else {
            foreach ($_GET as $key => $value) {
                $this->data["$key"] = $value;
            }
        }
        return $this->data;
    }

}
