<?php

namespace Root\Html\Services;

use \Root\Html\Db\Database;

class JobService
{
    private $dbConnection;

    public function __construct()
    {
        $this->dbConnection = new Database('php_vagas');
    }

    public function register($job)
    {
    }
}
