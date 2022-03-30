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

    /**
     * Class contructor.
     *
     * @param string $table
     */
    public function __construct($table = null)
    {
        $this->table = $table;
        $this->setConnection();
    }

    /**
     * Set connection into class params
     *
     * @return void
     */
    private function setConnection()
    {
        try {
            $this->connection = new PDO('mysql:host=' . self::HOST . ';dbname=' . self::NAME, self::USER, self::PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('ERROR: ' . $e);
        }
    }

    /**
     * Prepare and execute query
     *
     * @param string $query
     * @param array $params
     * @return PDOStatement
     */
    private function execute($query, $params = [])
    {
        $statement = $this->connection->prepare($query);
        $statement->execute($params);
        return $statement;
    }

    /**
     * Insert values into database.
     *
     * @param array $values
     * @return integer
     * @example values param must be assoc array [$key => $value]
     */
    public function insert($values)
    {
        $fields = array_keys($values);
        $params = array_values($values);
        $binds  = array_fill(0, count($values), '?');
        $query  = "INSERT INTO $this->table (" . implode(',', $fields) . ") VALUES (" . implode(',', $binds)  . ")";

        $this->execute($query, $params);

        return $this->connection->lastInsertId();
    }

    /**
     * Select and return values from database.
     *
     * @param string | null $where
     * @param string | null $order
     * @param string | null $limit
     * @return PDOStatement
     */
    public function select($where = null, $order = null, $limit = null, $fields = '*')
    {
        $where = strlen($where) ? "WHERE $where"    : '';
        $order = strlen($order) ? "ORDER BY $order" : '';
        $limit = strlen($limit) ? "LIMIT $limit"    : '';


        $query = "SELECT $fields FROM $this->table $where $order $limit";

        return $this->execute($query);
    }

    /**
     * Update values from database.
     *
     * @param string $where
     * @param array $values
     * @return boolean
     */
    public function update($where, $values)
    {
        $params = array_values($values);
        $values = array_keys($values);
        $values = array_map(function ($value) {
            return "$value=?";
        }, $values);
        $values = implode(',', $values);

        $query = "UPDATE $this->table SET $values WHERE $where";

        $this->execute($query, $params);

        return true;
    }

    /**
     * Delete some value from database.
     *
     * @param string $where
     * @return boolean
     */
    public function delete($where)
    {
        $query = "DELETE FROM $this->table WHERE $where";

        $this->execute($query);

        return true;
    }
}