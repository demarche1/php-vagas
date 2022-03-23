<?php

namespace Root\Html\Db;

use \PDO;
use \PDOException;

class Database
{
    const HOST = 'db';

    const NAME = 'php_vagas';

    const USER = 'php_vagas_admin';

    const PASS = 'php_vagas_admin_password';

    private $table;

    private $connection;

    public function __construct($table = null)
    {
        $this->table = $table;
        $this->setConnection();
    }

    private function setConnection()
    {
        try {
            $this->connection = new PDO('mysql:host=' . self::HOST . ';dbname=' . self::NAME, self::USER, self::PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('ERROR: ' . $e);
        }
    }

    private function execute($query, $params = [])
    {
        $statement = $this->connection->prepare($query);
        $statement->execute($params);
        return $statement;
    }

    public function insert($values)
    {
        $fields = array_keys($values);
        $params = array_values($values);
        $binds  = array_fill(0, count($values), '?');
        $query  = "INSERT INTO $this->table (" . implode(',', $fields) . ") VALUES (" . implode(',', $binds)  . ")";

        $this->execute($query, $params);

        return $this->connection->lastInsertId();
    }

    public function select($where = null, $order = null, $limit = null)
    {
        $where = strlen($where) ? "WHERE $where"    : '';
        $order = strlen($order) ? "ORDER BY $order" : '';
        $limit = strlen($limit) ? "LIMIT $limit"    : '';


        $query = "SELECT * FROM $this->table $where $order $limit";

        return $this->execute($query);
    }
}