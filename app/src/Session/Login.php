<?php

namespace Root\Html\Session;

class Login
{
    public static function isLogged()
    {
        return false;
    }

    public static function requireLogin()
    {
        if (!self::isLogged()) {
            header('Location: login.php');
            exit;
        }
    }

    public static function requireLogout()
    {
        if (self::isLogged()) {
            header('Location: index.php');
            exit;
        }
    }
}