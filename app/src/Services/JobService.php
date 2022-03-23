<?php

namespace Root\Html\Services;

use \Root\Html\Db\Database;
use \Root\Html\Entity\Job;
use \PDO;

class JobService
{
    private $dbConnection;

    public function __construct()
    {
        $this->dbConnection = new Database('jobs');
    }

    public function registerJob($job)
    {
        return $this->dbConnection->insert(
            [
                'title'       => $job->title,
                'description' => $job->description,
                'active'      => $job->active,
                'date'        => $job->date
            ]
        );
    }

    public function getJobs($where = null, $order = null, $limit = null)
    {
        $job = new Job();

        return $this
            ->dbConnection
            ->select($where, $order, $limit)
            ->fetchAll(PDO::FETCH_CLASS, $job->__toString());
    }
}