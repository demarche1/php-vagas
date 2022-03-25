<?php

require_once __DIR__ . "/vendor/autoload.php";
require __DIR__ . "/src/utils/validateRegister.php";

use \Root\Html\Entity\Job;
use \Root\Html\Services\JobService;

const PAGE_TITLE = 'Cadastrar vaga';
$job             = new Job();

if (isset($_POST['send'])) {
    $title       = filter_input(INPUT_POST, 'title');
    $description = filter_input(INPUT_POST, 'description');
    $active      = filter_input(INPUT_POST, 'active');

    if (!isValidRegister($title, $description, $active)) {
        header('Location: index.php?status=error');
        exit;
    };

    $job->title       = $title;
    $job->description = $description;
    $job->active      = $active;
    $job->date        = date('Y-m-d H:i:s');

    $jobService = new JobService();
    $job->id = $jobService->registerJob($job);

    header('Location: index.php?status=success');
    exit;
}

include __DIR__ . "/src/includes/header.php";
include __DIR__ . "/src/includes/form.php";
include __DIR__ . "/src/includes/footer.php";