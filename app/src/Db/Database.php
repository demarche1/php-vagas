<?php

namespace Root\Html\Db;

use PDO;

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
        } catch (\PDOException $e) {
            die('ERROR: ' . $e);
        }
    }
}
