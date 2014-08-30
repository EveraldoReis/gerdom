<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace FRAPS\Network;

/**
 * Description of POST
 *
 * @author webdev
 */
class POST extends AbstractRequest
{

    //put your code here

    public function data($key = false)
    {
        if ($key != false) {
            $this->data["$key"] = $_POST[$key];
        } else {
            foreach ($_POST as $key => $value) {
                $this->data["$key"] = $value;
            }
        }
        $this->files();
        return $this->data;
    }

    public function files($key = false)
    {
        if (isset($_FILES) && !empty($_FILES)) {
            if ($key != false) {
                $this->files["$key"] = $_FILES[$key];
            } else {
                foreach ($_FILES as $key => $value) {
                    if (!empty($value)) {
                        $this->files["$key"] = $value;
                    }
                }
            }
            return $this->files;
        }
    }

}
