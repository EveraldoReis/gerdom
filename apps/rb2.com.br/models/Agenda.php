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
 * Description of Comemoracao
 *
 * @author webdev
 */
class Agenda extends FRAPS\Core\Model
{

    //put your code here
    protected $_datasource = 'holidays_tasks';
    public $holiday_id = array('type' => 'int');
    public $client_id = array('type' => 'int');
    public $cdate = array('type' => 'date');
    public $mdate = array('type' => 'timestamp');
    public $active = array('type' => 'tinyint', 'length' => '1');

    public function getAll(array $conditions = array())
    {
        $sql = "SELECT * , holiday_id AS hid, "
                . "(SELECT GROUP_CONCAT(id SEPARATOR ', ') FROM clients WHERE id IN (SELECT client_id FROM holidays_tasks WHERE holiday_id = hid)) AS client_ids , "
                . "(SELECT GROUP_CONCAT(name SEPARATOR ', ') FROM clients WHERE id IN (SELECT client_id FROM holidays_tasks WHERE holiday_id = hid)) AS client_name , "
                . "(SELECT description FROM holidays WHERE id = holiday_id) AS holiday_name, "
                . "(SELECT holiday_date FROM holidays WHERE id = holiday_id) AS hdate, "
                . "(SELECT DATE_FORMAT(holiday_date, '%d/%m/%Y') FROM holidays WHERE id = holiday_id) AS holiday_date "
                . "FROM {$this->_datasource}";
        if (sizeof($conditions)) {
           $sql .= " WHERE " . Connection::bind($conditions, 'where', 'AND');
        }
        $sql .= ' GROUP BY holiday_id ORDER BY id';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(Connection::getBindedValues($conditions, 'where', 'AND'));
        return $stmt->fetchAll();
    }
    public function getAlerts()
    {
        $sql = "SELECT * , "
                . "IF(client_id =0, 'Todos', (SELECT name FROM clients WHERE id = client_id)) AS client_name , "
                . "(SELECT description FROM holidays WHERE id = holiday_id) AS holiday_name, "
                . "(SELECT holiday_date FROM holidays WHERE id = holiday_id) AS hdate, "
                . "(SELECT DATE_FORMAT(holiday_date, '%d/%m/%Y') FROM holidays WHERE id = holiday_id) AS holiday_date "
                . "FROM {$this->_datasource}";
        $sql .= " WHERE holiday_id IN (SELECT id FROM holidays WHERE DATE_FORMAT(DATE_ADD(NOW(), INTERVAL 7 DAY), '%Y-%m-%d') >= holiday_date)";
        $sql .= ' GROUP BY holiday_id ORDER BY id';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getDataDefinitions()
    {
        return array(
            'holiday_id' => array(
                'errorMsg' => 'Comemoração inválida',
                'filter' => FILTER_SANITIZE_NUMBER_INT,
                'flags' => FILTER_REQUIRE_SCALAR,
            ),
            'client_id' => array(
                'errorMsg' => 'ID do cliente é inválida',
                'filter' => FILTER_SANITIZE_STRING,
                'flags' => FILTER_REQUIRE_SCALAR,
            )
        );
    }
    
    public function get(array $conditions)
    {
        $sql = "SELECT *, holiday_id AS hid, "
                . "(SELECT description FROM holidays WHERE id = hid) AS holiday_name, "
                . "(SELECT DATE_FORMAT(holiday_date, '%d/%m/%Y') FROM holidays WHERE id = hid) AS holiday_date, "
                . "(SELECT GROUP_CONCAT(id SEPARATOR ', ') FROM clients WHERE id IN (SELECT client_id FROM holidays_tasks WHERE holiday_id = hid)) AS client_ids "
                . "FROM {$this->_datasource} ";
        $sql .= " WHERE " . Connection::bind($conditions, 'where', 'AND');
        $stmt = $this->connection->prepare($sql);
        try {
            $stmt->execute(Connection::getBindedValues($conditions, 'where', 'AND'));
            return $stmt->fetchObject();
        } catch (Exception $e) {
            Utils::setWarning($e->getMessage(), 'danger');
        }
    }

}
