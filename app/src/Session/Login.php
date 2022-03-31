<?php

namespace Root\Html\Session;

use JetBrains\PhpStorm\NoReturn;
use Root\Html\Entity\User;

class Login
{
    private static function initSession()
    {
        if(session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    /**
     * Create session with user info.
     *
     * @param User $user
     * @return void
     */
    #[NoReturn] public static function login(User $user)
    {
        self::initSession();

        $_SESSION['user'] = [
            'id'    => $user->id,
            'name'  => $user->name,
            'email' => $user->email
        ];

        header('Location: index.php');
        exit;
    }

    #[NoReturn] public static function logout()
    {
        self::initSession();

        unset($_SESSION['user']);

        header('Location: index.php');
        exit;
    }

    /**
     * Retrieves logged user.
     *
     * @return mixed|null
     */
    public static function getLoggedInUser(): mixed
    {
        self::initSession();

        return self::isLogged() ?  $_SESSION['user'] : null;
    }

    /**
     * Verify if user is logged in.
     *
     * @return bool
     */
    public static function isLogged(): bool
    {
        self::initSession();

        return isset($_SESSION['user']['id']);
    }

    /**
     * Require logged-in user into protected pages.
     *
     * @return void
     */
    public static function requireLogin()
    {
        if (!self::isLogged()) {
            header('Location: login.php');
            exit;
        }
    }

    /**
     * Require logged-out user into anonymous pages.
     *
     * @return void
     */
    public static function requireLogout()
    {
        if (self::isLogged()) {
            header('Location: index.php');
            exit;
        }
    }
}