<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace FRAPS;

use FRAPS_Utils;
use FRAPS_Config;

/**
 * Description of Generate
 *
 * @author webdev
 */
class Generate
{

    public $argv;
    public $template = 'scaffold';
    public $model;
    public $datasource;
    public $tmpController;
    public $tmpModel;
    public $tmpModelProperties;
    public $pass = 0;
    public $stepByStep = array(
        'Digite as propriedades do model no formato nome[:tipo[:length[:default value]]], uma propriedade por linha: ',
    );
    public $modelProperties;
    public $fields = array(
        '/^([\d\w]+)$/i' => '$1 varchar(255)',
        '/^([\d\w]+):(string|varchar)$/i' => '$1 varchar(255)',
        '/^([\d\w]+):(string|varchar):([0-2]+([0-5]+){0,2}|([0-9]+){1,2})$/i' => '`$1` varchar($3)',
        '/^([\d\w]+):(string|varchar):([0-2]+([0-5]+){0,2}|([0-9]+){1,2}):([^:]+)$/i' => '`$1` varchar($3) DEFAULT $6',
    );
    private $templates = array('model', 'scaffold', 'controller', 'view');

    //put your code here
    public function __construct($argv)
    {
        if (in_array('--app-name', $argv)) {
            $index = array_search('--app-name', $argv);
            unset($argv[$index]);
            unset($argv[$index + 1]);
        }
        $this->argv = array_values($argv);
        $this->init();
    }

    public function init()
    {
        unset($this->argv[0]);
        if (isset($this->argv[1]) && in_array($this->argv[1], $this->templates)) {
            $this->setTemplate($this->argv[1]);
            unset($this->argv[1]);
            if (isset($this->argv[2]) && (sizeof(explode(':', $this->argv[2])) <= 2)) {
                $this->setModel($this->argv[2]);
                $this->setController($this->argv[2]);
                unset($this->argv[2]);
            } elseif (isset($this->argv[2]) && (sizeof(explode(':', $this->argv[2])) > 2)) {
                exit("Nome do model é inválido. O nome do model precisa ser no formato: nome[:tabela]\n");
            } elseif (!isset($this->argv[2])) {
                exit("Por favor defina um nome para o model, no formato: nome[:tabela]\n");
            }
            $this->datasource = strtolower($this->controller);
            $this->setProperties();
        } elseif (isset($this->argv[1]) && !in_array($this->argv[1], $this->templates)) {
            echo("Nenhum template definido, será usado o template padrão (scaffold)\n");
            $this->setModel($this->argv[1]);
            $this->setController($this->argv[1]);
            $this->datasource = strtolower($this->controller);
            unset($this->argv[1]);
            $this->setProperties();
        } elseif (!isset($this->argv[1])) {
            exit("Por favor entre com o nome de um template [scaffold/model/controller/view] ou o nome de um model no formato: nome[:tabela]\n");
        }
    }

    public function setTemplate($template)
    {
        $this->template = $template;
    }

    public function setModel($model)
    {
        $this->model = Inflector::singularize($model);
        $this->model = Utils::camelize($this->model);
    }

    public function setController($controller)
    {
        $this->controller = Inflector::pluralize($controller);
        $this->controller = Utils::camelize($this->controller);
    }

    public function setTmpController($controller)
    {
        $this->tmpController = Inflector::pluralize($controller);
        $this->tmpController = Utils::camelize($this->tmpController);
    }

    public function setTmpModel($model)
    {
        $this->tmpModel = Inflector::singularize($model);
        $this->tmpModel = Utils::camelize($this->tmpModel);
    }

    public function setProperties()
    {
        foreach ($this->argv as $property) {
            $property = explode(':', $property);
            $name = trim($property[0]);
            $this->modelProperties[$name] = array();
            if (isset($property[1])) {
                $this->modelProperties[$name]['type'] = $property[1];
                if (in_array($property[1], array('hasone', 'hasmany', 'belongsto')) && isset($property[3])) {
                    $this->modelProperties[$name]['references'] = $property[3];
                    list($model, ) = explode('.', $property[3]);
                    $model = Utils::camelize($model);
                    $model = Inflector::singularize($model);
                    if (!file_exists(MODELS_DIR . "/$model.php")) {
                        if (Utils::confirm("O modem $model não existe, deseja criá-lo? [y/N] ")) {
                            $this->setTmpModel($model);
                            $this->setTmpController($model);
                            $this->stepByStep();
                        }
                    }
                } elseif (in_array($property[1], array('hasone', 'hasmany', 'belongsto')) && !isset($property[3])) {
                    
                }
            }
            if (isset($property[2])) {
                $this->modelProperties[$name]['length'] = $property[2];
            }
            if (isset($property[3])) {
                $this->modelProperties[$name]['default'] = $property[3];
            }
        }
    }

    public function setTmpProperties()
    {
        foreach ($this->tmpModelProperties as $key => $property) {
            $property = explode(':', $property);
            $name = trim($property[0]);
            $this->tmpModelProperties[$name] = array();
            if (isset($property[1])) {
                $this->tmpModelProperties[$name]['type'] = $property[1];
                if (in_array($property[1], array('hasone', 'hasmany', 'belongsto')) && isset($property[2])) {
                    list($model, ) = explode('.', $property[2]);
                    $model = Utils::camelize($model);
                    $model = Inflector::singularize($model);
                } elseif (in_array($property[1], array('hasone', 'hasmany', 'belongsto')) && !isset($property[2])) {
                    
                }
            }
            if (isset($property[2])) {
                $this->tmpModelProperties[$name]['length'] = $property[2];
            }
            if (isset($property[3])) {
                $this->tmpModelProperties[$name]['default'] = $property[3];
            }
            unset($this->tmpModelProperties[$key]);
        }
    }

    public function stepByStep()
    {
        if (isset($this->stepByStep[$this->pass])) {
            echo $this->stepByStep[$this->pass];
        }
        $command = trim(fgets(STDIN));
        if ($command === 'generate') {
            $this->setTmpProperties();
            $this->tmpModel();
        } else {
            if (!empty($command)) {
                $this->tmpModelProperties[$command] = $command;
            }
            $this->pass++;
            $this->stepByStep();
        }
    }

    public function model()
    {
        $this->modelProperties = implode(self::stringifyProperties($this->modelProperties));
        $output = <<<output
<?php
                
class {$this->model } extends FRAPS\Core\Model{
    protected \$_datasource = '$this->datasource';           
$this->modelProperties              
}

output;
        $file = MODELS_DIR . "/$this->model.php";
        if (file_exists($file)) {
            if (Utils::confirm("O arquivo $file já exite, deseja sobreescrevê-lo? [y/N] ")) {
                file_put_contents($file, $output);
            }
        } else {
            file_put_contents($file, $output);
        }
    }

    public function tmpModel()
    {
        $this->tmpModelProperties = implode(self::stringifyProperties($this->tmpModelProperties));
        $output = <<<output
<?php
                
class {$this->tmpModel } extends FRAPS\Core\Model{
    protected \$_datasource = '$this->tmpController';
$this->tmpModelProperties
}

output;
        $file = MODELS_DIR . "/$this->tmpModel.php";
        if (file_exists($file)) {
            if (Utils::confirm("O arquivo $file já exite, deseja sobreescrevê-lo? [y/N] ")) {
                file_put_contents($file, $output);
            }
        } else {
            file_put_contents($file, $output);
        }
    }

    public function controller()
    {
        $output = <<<output
<?php
                
class {$this->controller}Controller extends FRAPS\Core\Controller{
    public function index()
    {
              
    }  
    protected function add()
    {
       
    }
    protected function edit()
    {
       
    }
    protected function remove()
    {
      
    }
}
        
output;
        $file = CONTROLLERS_DIR . "/{$this->controller}Controller.php";
        if (file_exists($file)) {
            if (Utils::confirm("O arquivo $file já exite, deseja sobreescrevê-lo? [y/N] ")) {
                file_put_contents($file, $output);
            }
        } else {
            file_put_contents($file, $output);
        }
    }

    public function view()
    {
        $file = VIEWS_DIR . "/$this->controller";
        if (!file_exists($file)) {
            mkdir($file, 0755, true);
        }
        $file = VIEWS_DIR . "/$this->controller/index.tpl";
        if (file_exists($file)) {
            if (Utils::confirm("O arquivo $file já exite, deseja sobreescrevê-lo? [y/N] ")) {
                file_put_contents($file, null);
            }
        } else {
            file_put_contents($file, null);
        }
    }

    public function scaffold()
    {
        $this->model();
        $this->controller();
        $this->view();
    }

    public function exec()
    {
        $this->{$this->template}();
    }

    public static function stringifyProperties($array)
    {
        $out = array();
        if (sizeof($array)) {
            foreach ($array as $key => $values) {
                $output = '';
                $keys = array();
                $output .= "    public \$$key = array(";
                foreach ($values as $name => $value) {
                    $keys[$name] = "'$name' => '$value'";
                }
                $output .= implode(', ', $keys);
                $output .= ");\n";
                $out[$key] = $output;
            }
        }
        return $out;
    }

}
