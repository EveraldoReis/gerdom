<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use FRAPS\Config;

/**
 * Description of AuthController
 *
 * @author webdev
 */
class AuthController extends FRAPS\Core\Controller
{

    public $request;
    public $name = 'Auth';
    public $layout = 'login';

    //put your code here
    public function login()
    {
        
    }

    public function post_login()
    {
        $this->request->data['password'] = sha1($this->request->data['password']);
        $this->model->checkCredentials($this->request->data);
        header('Location:' . ROOT_URL);
    }

    public function logout()
    {
        unset($_SESSION['session_token']);
        header('Location:' . ROOT_URL);
    }

    protected function index()
    {
        
    }

}
