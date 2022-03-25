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
     * @return integer
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

    /**
     * Get job by ID from DB.
     *
     * @param integer $id
     * @return Job
     */
    public function getJobById($id)
    {
        $job = new Job();

        return $this
            ->dbConnection
            ->select("id = $id")
            ->fetchObject($job->__toString());
    }

    /**
     * Update job.
     *
     * @param Job $job
     * @return boolean
     */
    public function updateJob($job)
    {
        return $this
            ->dbConnection
            ->update(
                "id = $job->id",
                [
                    'title'       => $job->title,
                    'description' => $job->description,
                    'active'      => $job->active
                ]
            );
    }

    public function deleteJob($id)
    {
        return $this->dbConnection->delete("id = $id");
    }
}