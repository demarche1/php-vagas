<?php

namespace Root\Html\Services;

use \Root\Html\Db\Database;
use \Root\Html\Entity\Job;
use \PDO;

class JobService
{
    private Database $dbConnection;

    public function __construct()
    {
        $this->dbConnection = new Database('jobs');
    }

    /**
     * Call query-builder to insert a job to DB.
     *
     * @param Job $job
     * @return integer
     */
    public function registerJob(Job $job): int
    {
        return $this->dbConnection->insert(
            [
                'title'       => $job->title,
                'description' => $job->description,
                'active'      => $job->active,
                'date'        => $job->date,
                'user_id'     => $job->user_id
            ]
        );
    }

    /**
     * Retrieves array of job instances
     *
     * @param string | null $where
     * @param string | null $order
     * @param string | null $limit
     * @return Job[]
     */
    public function getJobs(string $where = null, string $order = null, string $limit = null): array
    {
        return $this
            ->dbConnection
            ->select($where, $order, $limit)
            ->fetchAll(PDO::FETCH_CLASS, Job::class);
    }

    /**
     * Retrieves quantity of jobs
     *
     * @param string | null $where
     * @return integer
     */
    public function getJobsQuantity(string $where = null): int
    {
        return $this
            ->dbConnection
            ->select($where, null, null, 'COUNT(*) as quantity')
            ->fetchObject()
            ->quantity;
    }

    /**
     * Get job by ID from DB.
     *
     * @param integer $id
     * @return Job
     */
    public function getJobById(int $id): Job
    {
        return $this
            ->dbConnection
            ->select("id = $id")
            ->fetchObject(Job::class);
    }

    /**
     * Update job.
     *
     * @param Job $job
     * @return boolean
     */
    public function updateJob(Job $job): bool
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

    /**
     * Delete Job from DB.
     *
     * @param int $id
     * @return bool
     */
    public function deleteJob(int $id): bool
    {
        return $this->dbConnection->delete("id = $id");
    }
}