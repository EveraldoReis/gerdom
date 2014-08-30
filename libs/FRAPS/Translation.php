<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace FRAPS;

use FRAPS\Utils;
use FRAPS\Inflector;

use FRAPS\DBC\Connection;
use FRAPS\Network\POST;

/**
 * Description of Language
 *
 * @author webdev
 */
class Translation extends \RecursiveArrayIterator
{

    //put your code here
    public static $connection;
    private $_datasource = 'translations';

    public function __construct()
    {
        $this->connection = DBC\Connection::init();
        $this->getTranslations();
    }

    public function getTranslations()
    {
        $sql = "SELECT `default`, `" . USER_LANGUAGE . "` FROM translations";
        $stmt = $this->connection->query($sql);
        while ($translation = $stmt->fetchObject()) {
            $this->offsetSet($translation->default, $translation->{USER_LANGUAGE});
        }
    }

    public function save(array $data)
    {
        $items = array();
        $sql = "INSERT INTO {$this->_datasource} SET ";
        if (!isset($data['cdate'])) {
            $data['cdate'] = date('Y-m-d H:i:s');
        }
        echo $sql .= Connection::bind($data);
        $stmt = $this->connection->prepare($sql);
        try {
            $stmt->execute(Connection::getBindedValues($data));
            Utils::setWarning('Dados salvos com sucesso!', 'success');
            return $this->connection->lastInsertId();
        } catch (Exception $e) {
            Utils::setWarning($e->getMessage(), 'danger');
        }
    }

}
