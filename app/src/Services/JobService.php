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

    /**
     * Call querybuilder to insert a job to DB.
     *
     * @param Job $job
     * @return interger
     */
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

    /**
     * Retrieves array of job intances
     *
     * @param string | null $where
     * @param string | null $order
     * @param string | null $limit
     * @return Job[]
     */
    public function getJobs($where = null, $order = null, $limit = null)
    {
        $job = new Job();

        return $this
            ->dbConnection
            ->select($where, $order, $limit)
            ->fetchAll(PDO::FETCH_CLASS, $job->__toString());
    }
}