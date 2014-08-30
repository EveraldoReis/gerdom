<?php

use FRAPS\DBC\Connection;
use FRAPS\Utils;
use FRAPS\Inflector;
class Pagamento extends FRAPS\Core\Model
{

    protected $_datasource = 'payments';
    public $domain_id = array('type' => 'int');
    public $last_payment = array('type' => 'date');
    public $cdate = array('type' => 'datetime');
    public $mdate = array('type' => 'timestamp');
    public $active = array('type' => 'tinyint', 'length' => '1');

    public function getAll(array $conditions = array())
    {
        $sql = "SELECT *, id AS did, "
                . "(SELECT id FROM domains WHERE id = domain_id) AS domain_id, "
                . "(SELECT domain FROM domains WHERE id = domain_id) AS domain_name "
                . "FROM {$this->_datasource} ";
        if (sizeof($where)) {
            $sql .= " WHERE " . Connection::bind($conditions, 'where', 'AND');
        }
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(Connection::getBindedValues($conditions, 'where', 'AND'));
        return $stmt->fetchAll();
    }
    
    public function getSpec(array $conditions)
    {
        $sql = "SELECT * FROM {$this->_datasource} ";
        $sql .= " WHERE DATE_FORMAT(last_payment, '%Y-%m') = DATE_FORMAT(:where_last_payment, '%Y-%m') AND domain_id = :where_domain_id";
        $sql .= " LIMIT 1 ";
        $stmt = $this->connection->prepare($sql);
        try {
            $stmt->execute(Connection::getBindedValues($conditions, 'where', 'AND'));
            return $stmt->fetchObject();
        } catch (Exception $e) {
            Utils::setWarning($e->getMessage(), 'danger');
        }
    }
    
    public function getDataDefinitions()
    {
        return array(
            'domain_id' => array(
                'errorMsg' => 'ID do dominio (domain_id) precisa ser um número inteiro',
                'filter' => FILTER_SANITIZE_NUMBER_INT,
                'flags' => FILTER_REQUIRE_SCALAR,
            ),
            'last_payment' => array(
                'errorMsg' => 'Data de pagamento (last_payment) precisa ser uma string no formato aaaa-mm-dd.',
                'filter' => FILTER_VALIDATE_REGEXP,
                'flags' => FILTER_REQUIRE_SCALAR,
                'options' => array('regexp'=>'#^\d{4}-\d{2}-\d{2}$#')
            )
        );
    }

}
