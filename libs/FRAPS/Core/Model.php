<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace FRAPS\Core;

use FRAPS\Utils;
use FRAPS\Inflector;
use FRAPS\DBC\Connection;
use FRAPS\Network\POST;
use FRAPS\Filter;

/**
 * Description of Model
 *
 * @author webdev
 */
class Model
{

    //put your code here
    public $connection;

    function __construct()
    {
        $this->connection = Connection::init();
    }

    public function getAll(array $conditions = array())
    {
        $sql = "SELECT * FROM {$this->_datasource} ";
        if (sizeof($conditions)) {
            $sql .= " WHERE " . Connection::bind($conditions, 'where', 'AND');
        }
        $stmt = $this->connection->prepare($sql);
        try {
            $stmt->execute(Connection::getBindedValues($conditions, 'where', 'AND'));
            return $stmt->fetchAll();
        } catch (Exception $e) {
            Utils::setWarning($e->getMessage(), 'danger');
        }
    }

    public function get(array $conditions)
    {
        $sql = "SELECT * FROM {$this->_datasource} ";
        $sql .= " WHERE " . Connection::bind($conditions, 'where', 'AND');
        $sql .= " LIMIT 1 ";
        $stmt = $this->connection->prepare($sql);
        try {
            $stmt->execute(Connection::getBindedValues($conditions, 'where', 'AND'));
            return $stmt->fetchObject();
        } catch (Exception $e) {
            Utils::setWarning($e->getMessage(), 'danger');
        }
    }

    public function getNextInsertID()
    {
        $sql = "SELECT (MAX(id) + 1) AS next_insert_id  FROM {$this->_datasource} LIMIT 1";
        $stmt = $this->connection->prepare($sql);
        try {
            $stmt->execute();
            return $stmt->fetchObject()->next_insert_id;
        } catch (Exception $e) {
            Utils::setWarning($e->getMessage(), 'danger');
        }
    }

    public function save(array $data)
    {
        $data = Filter::filter($data, $this->getDataDefinitions());
        $items = array();
        $sql = "INSERT INTO {$this->_datasource} SET ";
        if (!isset($data['cdate'])) {
            $data['cdate'] = date('Y-m-d H:i:s');
        }
        $sql .= Connection::bind($data);
        $stmt = $this->connection->prepare($sql);
        try {
            $stmt->execute(Connection::getBindedValues($data));
            Utils::setWarning('Dados salvos com sucesso!', 'success');
            return $this->connection->lastInsertId();
        } catch (Exception $e) {
            Utils::setWarning($e->getMessage(), 'danger');
        }
    }

    public function update(array $data, $conditions)
    {
        $data = Filter::filter($data, $this->getDataDefinitions());
        $items = array();
        $sql = "UPDATE {$this->_datasource} SET ";
        if (!isset($data['mdate'])) {
            $data['mdate'] = date('Y-m-d H:i:s');
        }
        $sql .= Connection::bind($data);
        $sql .= " WHERE " . Connection::bind($conditions, 'where', 'AND');
        $stmt = $this->connection->prepare($sql);
        try {
            $stmt->execute(array_merge(Connection::getBindedValues($data), Connection::getBindedValues($conditions, 'where', 'AND')));
            Utils::setWarning('Dados atualizados com sucesso!', 'success');
            return $stmt;
        } catch (Exception $e) {
            Utils::setWarning($e->getMessage(), 'danger');
        }
    }

    public function delete(array $conditions)
    {
        $items = array();
        $sql = "DELETE FROM {$this->_datasource} ";
        $sql .= " WHERE " . Connection::bind($conditions, 'where', 'AND');
        $stmt = $this->connection->prepare($sql);
        try {
            $stmt->execute(Connection::getBindedValues($conditions, 'where', 'AND'));
            Utils::setWarning('Item deletado com sucesso!', 'success');
            return $stmt;
        } catch (Exception $e) {
            Utils::setWarning($e->getMessage(), 'danger');
        }
    }
    

}
