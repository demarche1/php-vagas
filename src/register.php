<?php

if (isset($_POST['title'], $_POST['description'], $_POST['active'])) {
    die('Cadastrado!');
}

require __DIR__ . "/vendor/autoload.php";

include __DIR__ . "/includes/header.php";

include __DIR__ . "/includes/form.php";

include __DIR__ . "/includes/footer.php";