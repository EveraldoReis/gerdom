<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use FRAPS\DBC\Connection;
use FRAPS\Utils;
use FRAPS\Inflector;

/**
 * Description of Auth
 *
 * @author webdev
 */
class Auth extends FRAPS\Core\Model
{

    //put your code here
    protected $_datasource = 'accounts';

    public function checkCredentials(array $data)
    {
        $sql = "SELECT token FROM {$this->_datasource} WHERE username = :where_username AND password = :where_password";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(Connection::getBindedValues($data, 'where', 'AND'));
        if ($stmt->fetchObject() != false) {
            $token = sha1(microtime());
            $sql = "UPDATE {$this->_datasource} SET token = '$token' WHERE username = :where_username AND password = :where_password";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute(Connection::getBindedValues($data, 'where', 'AND'));
            $_SESSION['session_token'] = $token;
        } else {
            unset($_SESSION['session_token']);
            Utils::setWarning('Erro ao logar. Verifique seu usuário e senha', 'danger');
        }
    }

    public function checkFacebookCredentials(array $data)
    {
        $token = $data['token'];
        unset($data['token']);
        $sql = "SELECT token FROM {$this->_datasource} WHERE username = :where_username AND fbid = :where_fbid";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(Connection::getBindedValues($data, 'where', 'AND'));
        if ($stmt->fetchObject() != false) {
            $sql = "UPDATE {$this->_datasource} SET token = '$token' WHERE username = :where_username AND fbid = :where_fbid";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute(Connection::getBindedValues($data, 'where', 'AND'));
            $_SESSION['session_token'] = $token;
        } else {
            unset($_SESSION['session_token']);
            Utils::setWarning('Erro ao logar. Verifique seu usuário.', 'danger');
        }
    }

    public function recheckCredentials()
    {
        if (isset($_SESSION['session_token'])) {
            $sql = "SELECT token FROM {$this->_datasource} WHERE token = :where_session_token";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute(Connection::getBindedValues(array('session_token' => $_SESSION['session_token']), 'where', 'AND'));
            if ($stmt->fetchObject() == false) {
                if (!MULTI_LOGIN) {
                    unset($_SESSION['session_token']);
                    Utils::setWarning('Seu token de acesso mudou, isso significa que alguém fez login de outro local! Cuidado, se foi alguém não autorizado sua aplicação pode estar em risco.<br/> O logout automático foi efetuado. Para habilitar multi acesso mude a diretiva MULTI_LOGIN no arquivo de configuração do app.', 'danger');
                } else {
                    Utils::setWarning('O token de seção mudou, isso significa que alguém fez login de outro local! Cuidado, se foi alguém não autorizado sua aplicação pode estar em risco.', 'danger');
                }
            }
        }
    }

    public function logout()
    {
        unset($_SESSION['session_token']);
    }
    public function getDataDefinitions()
    {
        return array(
            'id' => array(
                'errorMsg' => 'ID inválida',
                'filter' => FILTER_SANITIZE_NUMBER_INT|FILTER_VALIDATE_STRING,
                'flags' => FILTER_REQUIRE_SCALAR,
                'options' => ''
            ),
            'username' => array(
                'errorMsg' => 'Nome de usuário deve conter apensa caracteres alfa-numéricos',
                'filter' => FILTER_SANITIZE_STRING,
                'flags' => FILTER_REQUIRE_SCALAR,
                'options' => ''
            ),
            'password' => array(
                'errorMsg' => '',
                'filter' => FILTER_VALIDATE_EMAIL,
                'flags' => FILTER_FLAG_NONE,
                'options' => ''
            )
        );
    }

}
