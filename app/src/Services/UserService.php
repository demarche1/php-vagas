<?php

namespace Root\Html\Services;

use \Root\Html\Db\Database;
use \Root\Html\Entity\User;

class UserService
{
    private Database $dbConnection;

    public function __construct()
    {
        $this->dbConnection = new Database('users');
    }

    /**
     * Call query-builder to insert a user to DB.
     *
     * @param User $user
     * @return integer
     */
    public function registerUser(User $user): int
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
     * @return User|bool
     */
    public function getUserByEmail(string $email): User|bool
    {
        return $this
            ->dbConnection
            ->select("email = '$email'")
            ->fetchObject(User::class);
    }
}