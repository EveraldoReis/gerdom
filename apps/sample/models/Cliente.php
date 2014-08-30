<?php

use FRAPS\DBC\Connection;
use FRAPS\Utils;
use FRAPS\Inflector;
class Cliente extends FRAPS\Core\Model
{

    protected $_datasource = 'clients';
    public $name = array('type' => 'string', 'length' => '80');
    public $telephone = array('type' => 'string', 'length' => '80');
    public $email = array('type' => 'string', 'length' => '80');
    public $cdate = array('type' => 'datetime');
    public $mdate = array('type' => 'timestamp');
    public $active = array('type' => 'tinyint', 'length' => '1');

    public function getAll(array $conditions = array())
    {
        $sql = "SELECT *, "
                . " (SELECT GROUP_CONCAT(domain SEPARATOR ', ') FROM domains WHERE client_id = t1.id) AS domains "
                . " FROM {$this->_datasource} AS t1 ";
        if (sizeof($conditions)) {
            $sql .= " WHERE " . Connection::getBindedValues($conditions);
        }
        $sql .= ' ORDER BY t1.name';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(Connection::getBindedValues($conditions));
        return $stmt->fetchAll();
    }

    public function getDataDefinitions()
    {
        return array(
            'name' => array(
                'errorMsg' => 'O nome do cliente deve conter somente caracteres alfa-numéricos',
                'filter' => FILTER_SANITIZE_STRING,
                'flags' => FILTER_REQUIRE_SCALAR,
            ),
            'email' => array(
                'null' => true,
                'errorMsg' => 'E-mail inválido',
                'filter' => FILTER_UNSAFE_RAW,
                'flags' => FILTER_FLAG_NONE,
            ),
            'telephone' => array(
                'null' => true,
                'errorMsg' => 'Telefone inválido',
                'filter' => FILTER_UNSAFE_RAW,
                'flags' => FILTER_FLAG_NONE,
            )
        );
    }

}
