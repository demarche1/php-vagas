<?php
require_once __DIR__ . "/vendor/autoload.php";

use \Root\Html\Entity\User;
use \Root\Html\Services\UserService;
use \Root\Html\Session\Login;

Login::requireLogout();

if (isset($_POST['send'])) {
    $userService = new UserService();

    if ($_POST['send'] === 'login') {
        $email    = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');

        $user = $userService->getUserByEmail($email);

        if (!$user instanceof User || !password_verify($password, $user->password)) {
            header('Location: login.php?status=error&loginError=true');
            exit;
        }

        Login::login($user);
    }

    if ($_POST['send'] === 'register') {
        $user = new User();
        $user->name     = filter_input(INPUT_POST, 'name');
        $user->email    = filter_input(INPUT_POST, 'email');
        $user->password = filter_input(INPUT_POST, 'password');

        if (!$user->isValid()) {
            header('Location: login.php?status=error&registerError=true');
            exit;
        }

        $user->hashPassword();

        if (!$user->id = $userService->registerUser($user)) {
            header('Location: login.php?status=error&registerError=true');
            exit;
        }

        header('Location: index.php?status=success&registerSuccess=true');
        exit;
    }
}

include __DIR__ . "/src/includes/header.php";
include __DIR__ . "/src/includes/login-form.php";
include __DIR__ . "/src/includes/footer.php";