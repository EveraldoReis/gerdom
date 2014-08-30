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
class Comemoracao extends FRAPS\Core\Model
{

    //put your code here
    protected $_datasource = 'holidays';
    public $description = array('type' => 'string', 'length' => '255');
    public $holiday_date = array('type' => 'date');
    public $cdate = array('type' => 'date');
    public $mdate = array('type' => 'timestamp');
    public $active = array('type' => 'tinyint', 'length' => '1');

    public function getAll(array $conditions = array())
    {
        $sql = "SELECT *, DATE_FORMAT(holiday_date, '%d') AS day, DATE_FORMAT(holiday_date, '%m') AS month, DATE_FORMAT(holiday_date, '%y') AS year "
                . "FROM {$this->_datasource}";
        if (sizeof($conditions)) {
            $sql .= " WHERE " . Connection::bind($conditions, 'where', 'AND');
        }
        $sql .= ' ORDER BY description';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(Connection::getBindedValues($conditions, 'where', 'AND'));
        return $stmt->fetchAll();
    }

    public function getDataDefinitions()
    {
        return array(
            'description' => array(
                'errorMsg' => 'Descrição precisa ser uma string',
                'filter' => FILTER_SANITIZE_STRING,
                'flags' => FILTER_REQUIRE_SCALAR,
            ),
            'holiday_date' => array(
                'errorMsg' => 'Data da comemoração (holiday_date) precisa ser uma string no formato aaaa-mm-dd.',
                'filter' => FILTER_VALIDATE_REGEXP,
                'flags' => FILTER_REQUIRE_SCALAR,
                'options' => array('regexp' => '#^\d{4}-\d{2}-\d{2}$#')
            ),
            'cdate' => array(
                'errorMsg' => 'Data de cadastro (cdate) precisa ser uma string no formato aaaa-mm-dd.',
                'filter' => FILTER_VALIDATE_REGEXP,
                'flags' => FILTER_REQUIRE_SCALAR,
                'options' => array('regexp' => '#^\d{4}-\d{2}-\d{2}$#')
            ),
        );
    }

}
