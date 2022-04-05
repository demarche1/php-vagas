<?php

use \Root\Html\Session\Login;

$loggedUser = Login::getLoggedInUser();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>PHP Vagas</title>
</head>

<body class="bg-dark text-light">
    <div class="container">
        <header class="bg-success p-2" style="--bs-bg-opacity: .5;">
            <a class="text-light" href="index.php"><h1 >PHP Vagas</h1></a>

            <p>Exemplo de CRUD em PHP OOP</p>
        </header>

        <section class="d-flex justify-content-end">
            <?php
                if ($loggedUser) {
                    echo '
                        <div class="dropdown">
                            <p class="dropdown-toggle" role="button" data-bs-toggle="dropdown">
                                Olá '. $loggedUser["name"] .'
                            </p>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/logout.php">Sair</a></li>
                                <li><a class="dropdown-item" href="/user-jobs.php">Meus Cadastros</a></li>
                            </ul>
                        </div>
                    ';
                } else {
                    echo '
                        <a class="text-light" href="login.php">Entrar</a>
                    ';
                }
            ?>
        </section>

