<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace FRAPS\Network;

use FRAPS\Utils;
use FRAPS\Inflector;


/**
 * Description of Request
 *
 * @author webdev
 */
abstract class AbstractRequest
{

//put your code here
    public $url;
    public $namespace = '';
    public $controller = 'Pages';
    public $action = 'index';
    public $method;
    private $_reflector;
    public $params = array();
    public $data = array();
    public $files = array();

    public function __construct($url)
    {
        $this->data();
        $this->url = parse_url($url);
        $this->method = $_SERVER['REQUEST_METHOD'];
        if (isset($this->url['path'])) {
            $this->url['path'] = preg_replace('#'.ROOT_URL.'#i', '', $this->url['path'], 1);
            $this->url['path'] = str_replace($_SERVER['QUERY_STRING'], '', $this->url['path']);
            $path = explode('/', $this->url['path']);
            $controller = null;
            if (isset($path[1]) && !empty($path[1])) {
                $controller = Utils::camelize(Inflector::pluralize($path[0])) . '\\' . Utils::camelize(Inflector::pluralize($path[1])) . 'Controller';
            }
            if (class_exists($controller)) {
                if (isset($path[0]) && !empty($path[0])) {
                    $this->namespace = Utils::camelize($path[0]);
                    $this->namespace = Inflector::pluralize($this->namespace);
                    unset($path[0]);
                }
                if (isset($path[1]) && !empty($path[1])) {
                    $this->controller = Utils::camelize($path[1]);
                    $this->controller = Inflector::pluralize($this->controller);
                    unset($path[1]);
                }
                if (isset($path[2]) && !empty($path[2])) {
                    $this->action = $path[2];
                    unset($path[2]);
                }
            } else {
                if (isset($path[0]) && !empty($path[0])) {
                    $this->controller = Utils::camelize($path[0]);
                    $this->controller = Inflector::pluralize($this->controller);
                    unset($path[0]);
                }
                if (isset($path[1]) && !empty($path[1])) {
                    $this->action = $path[1];
                    unset($path[1]);
                }
            }
            $this->params = array_values($path);
            $this->params += $_GET;
        }
        if (strtolower($this->method) == 'post') {
            $this->action = strtolower($_SERVER['REQUEST_METHOD']) . '_' . $this->action;
        }
    }

    function namespaceExists($namespace)
    {
        $namespace .= "\\";
        foreach (get_declared_classes() as $name)
            if (strpos($name, $namespace) === 0)
                return true;
        return false;
    }

    public function namespacePath()
    {
        return !empty($this->namespace) ? '/' . Inflector::pluralize(Utils::camelize($this->namespace)) : '';
    }

    public function getNS()
    {
        return !empty($this->namespace) ? $this->namespace . '\\' : '';
    }

    public function renderView()
    {
        $file = CONTROLLERS_DIR . "/{$this->controller}Controller.php";
        $controller = $this->getNS() . $this->controller . 'Controller';
        if (!class_exists($controller)) {
            $controller = $this->controller . 'Controller';
        }
        if (class_exists($controller)) {
            $controller = new $controller;
            $controller->request = $this;
            $controller->namespace = $this->namespace;
            $controller->setName($this->controller);
            $this->_reflector = new \ReflectionClass($controller);
            if (method_exists($controller, $this->action)) {
                if ($this->_reflector->getMethod($this->action)->isPublic() || $controller->isAuthorized()) {
                    $controller->action = $this->action;
                } else {
                    $auth = key($controller->auth);
                    $controller = new $auth;
                    $controller->request = $this;
                    $controller->action = $controller->auth[$auth];
                }
                $controller->renderAction();
            } else {
                throw new \Exception("O método $this->action não existe no controller $controller");
            }
        } else {
            throw new \Exception("O controller {$controller} não existe");
        }
    }

}
