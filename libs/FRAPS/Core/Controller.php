<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace FRAPS\Core;

use FRAPS\Utils;
use FRAPS\Inflector;

/**
 * Description of Controller
 *
 * @author webdev
 */
class Controller
{

    public $auth = array('AuthController' => 'login');
    public $data = array();
    public $translater;
    public $request;
    public $facebook;
    public $namespace = '';
    protected $name = 'Pages';
    public $action = 'index';
    private $_data = array();
    public $layout = 'default';

    function __construct()
    {
        $config = array(
            'appId' => FB_APP_ID,
            'secret' => FB_APP_SECRET,
            'fileUpload' => true, // optional
            'allowSignedRequest' => false, // optional, but should be set to false for non-canvas apps
        );

        $this->facebook = new \Facebook($config);
        $this->translater = new \FRAPS\Translation;
        $this->set('translater', $this->translater);
        $this->model('Auth')->recheckCredentials();
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    //put your code here
    public function set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function namespacePath()
    {
        return !empty($this->namespace) ? '/' . Inflector::pluralize(Utils::camelize($this->namespace)) : '';
    }

    public function getNS()
    {
        return !empty($this->namespace) ? $this->namespace . '\\' : '';
    }

    public function renderAction()
    {
        $model = $this->getNS() . Inflector::singularize($this->name);
        $this->model = new $model;
        $file = VIEWS_DIR . $this->namespacePath() . "/$this->name/$this->action.tpl";
        $this->{$this->action}();
        if (file_exists($file)) {
            ob_start();
            extract($this->data);
            require $file;
            $this->_data['content'] = ob_get_contents();
            ob_end_clean();
            $file = LAYOUTS_DIR . "/$this->layout.tpl";
            if (file_exists($file)) {
                require $file;
            } else {
                throw new \Exception("O arquivo $file não existe");
            }
        } else {
            throw new \Exception("O arquivo $file não existe");
        }
    }

    public function fetch($object)
    {
        return $this->_data[$object];
    }

    public function element($object)
    {
        extract($this->data);
        ob_start();
        require ELEMENTS_DIR . "/$object.tpl";
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

    public function action(array $controller)
    {
        $view = key($controller);
        $action = $controller[$view];
        extract($this->data);
        ob_start();
        require VIEWS_DIR . "/$view/$action.tpl";
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

    public function isAuthorized()
    {
        return isset($_SESSION['session_token']);
    }

    public function model($model, $params = null)
    {
        return new $model($params);
    }

    public function setWarning($message, $type = 'info')
    {
        Utils::setWarning($message, $type);
    }

    public function getWarning($type = 'info')
    {
        if (isset($_SESSION['warning'])) {
            if (is_string($_SESSION['warning'])) {
                unset($_SESSION['warning']);
            }
            if (isset($_SESSION['warning'][$type])) {
                $warning = $_SESSION['warning'][$type];
                if ($this->request->method != 'POST') {
                    unset($_SESSION['warning']);
                }
                $warning = preg_replace('/.*duplicate entry \'([^\']+)\'.*/i', 'Entrada $1 já existe no banco de dados', $warning);
                return "<div class=\"alert alert-$type\">$warning</div>";
            }
        }
    }

    public function redirect($targetUrl = false)
    {
        if ($targetUrl) {
            if (is_string($targetUrl)) {
                header('Location:' . $targetUrl);
            } elseif (is_array($targetUrl)) {
                $controller = key($targetUrl);
                $action = $targetUrl[$controller];
                if (is_array($action)) {
                    $namespace = key($targetUrl);
                    $controller = $targetUrl[$namespace];
                    $action = $controller[key($namespace)];
                    header("Location:/$namespace/$controller/$action");
                } else {
                    header("Location:/$controller/$action");
                }
            } else {
                throw new Exception('Url de redirecionamento inválida');
            }
        } else {
            if (isset($_SERVER['HTTP_REFERER'])) {
                header('Location:' . $_SERVER['HTTP_REFERER']);
            }
        }
    }

    public function __toString()
    {
        return get_class($this);
    }

}
