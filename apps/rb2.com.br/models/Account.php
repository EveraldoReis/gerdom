<?php

use FRAPS\DBC\Connection;
use FRAPS\Utils;
use FRAPS\Inflector;
class Account extends FRAPS\Core\Model
{

    protected $_datasource = 'accounts';
    public $username = array('type' => 'string', 'length' => '100');
    public $password = array('type' => 'string', 'length' => '50');
    public $role = array('type' => 'set', 'length' => 'root,admin,user');

    public function getDataDefinitions()
    {
        return array(
            'username' => array(
                'errorMsg' => 'Nome de usuário deve ser um e-mail',
                'filter' => FILTER_VALIDATE_EMAIL,
                'flags' => FILTER_REQUIRE_SCALAR,
            ),
            'password' => array(
                'errorMsg' => 'Por favor digite uma senha',
                'filter' => FILTER_UNSAFE_RAW,
                'flags' => FILTER_REQUIRE_SCALAR,
            ),
            'role' => array(
                'errorMsg' => 'Selecione o tipo de privilegio',
                'filter' => FILTER_SANITIZE_STRING,
                'flags' => FILTER_REQUIRE_SCALAR,
            )
        );
    }

}
