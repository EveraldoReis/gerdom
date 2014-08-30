<?php

use FRAPS\DBC\Connection;
use FRAPS\Utils;
use FRAPS\Inflector;
class Dominio extends FRAPS\Core\Model
{

    protected $_datasource = 'domains';
    public $client_id = array('type' => 'hasone', 'length' => 'clente.id');
    public $domain = array('type' => 'string', 'length' => '80');
    public $cdate = array('type' => 'datetime');
    public $mdate = array('type' => 'timestamp');
    public $active = array('type' => 'tinyint', 'length' => '1');

    public function getAll(array $conditions = array())
    {
        $sql = "SELECT *, id AS did, "
                . "(SELECT MAX(last_payment) FROM payments WHERE domain_id = did) AS last_payment , "
                . "(SELECT id FROM payments WHERE domain_id = did ORDER BY last_payment DESC LIMIT 1) AS payment_id "
                . "FROM {$this->_datasource}";
        if (sizeof($conditions)) {
            $sql .= " WHERE " . Connection::getBindedValues($conditions, 'where', 'AND');
        }
        $sql .= ' ORDER BY domain';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(Connection::getBindedValues($conditions, 'where', 'AND'));
        return $stmt->fetchAll();
    }

    public function getDataDefinitions()
    {
        return array(
            'client_id' => array(
                'errorMsg' => 'ID do cliente (client_id) presa ser um número inteiro ',
                'filter' => FILTER_SANITIZE_STRING,
                'flags' => FILTER_REQUIRE_SCALAR,
            ),
            'domain' => array(
                'errorMsg' => 'Domínio (domain) precisa ser uma URL',
                'filter' => FILTER_SANITIZE_URL,
                'flags' => FILTER_REQUIRE_SCALAR,
            ),
            'free' => array(
                'errorMsg' => '',
                'filter' => FILTER_SANITIZE_NUMBER_INT,
                'flags' => FILTER_REQUIRE_SCALAR,
            ),
            'cdate' => array(
                'errorMsg' => 'Data de cadastro (cdate) precisa ser uma string no formato aaaa-mm-dd.',
                'filter' => FILTER_VALIDATE_REGEXP,
                'flags' => FILTER_REQUIRE_SCALAR,
                'options' => array('regexp'=>'#^\d{4}-\d{2}-\d{2}$#')
            ),
        );
    }

}
