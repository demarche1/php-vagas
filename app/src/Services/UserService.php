<?php

namespace Root\Html\Services;

use \Root\Html\Db\Database;
use \Root\Html\Entity\User;
use \PDO;

class UserService
{
    private $dbConnection;

    public function __construct()
    {
        $this->dbConnection = new Database('users');
    }

    /**
     * Call querybuilder to insert a user to DB.
     *
     * @param User $user
     * @return integer
     */
    public function registerUser($user)
    {
        return $this->dbConnection->insert(
            [
                'name'     => $user->name,
                'email'    => $user->email,
                'password' => $user->password
            ]
        );
    }

    /**
     * Get User by email from DB.
     *
     * @param string $email
     * @return User
     */
    public function getUserByEmail($email)
    {
        return $this
            ->dbConnection
            ->select("email = '$email'")
            ->fetchObject(User::class);
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
        return $this
            ->dbConnection
            ->select($where, $order, $limit)
            ->fetchAll(PDO::FETCH_CLASS, Job::class);
    }

    /**
     * Retrieves quantity of jobs
     *
     * @param string | null $where
     * @param string | null $order
     * @param string | null $limit
     * @return integer
     */
    public function getJobsQuantity($where = null)
    {
        return $this
            ->dbConnection
            ->select($where, null, null, 'COUNT(*) as quantity')
            ->fetchObject()
            ->quantity;
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