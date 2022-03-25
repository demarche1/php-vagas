<?php


require_once __DIR__ . "/vendor/autoload.php";
require __DIR__ . "/src/utils/validateRegister.php";

use \Root\Html\Entity\Job;
use \Root\Html\Services\JobService;

const PAGE_TITLE = 'Editar vaga';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php?status=error');
    exit;
}

$id         = filter_input(INPUT_GET, 'id');
$jobService = new JobService();
$job        = $jobService->getJobById($id);

if (!$job instanceof Job) {
    header('Location: index.php?status=error');
    exit;
}

$title       = filter_input(INPUT_POST, 'title');
$description = filter_input(INPUT_POST, 'description');
$active      = filter_input(INPUT_POST, 'active');

if (isValidRegister($title, $description, $active)) {
    $job->title       = $title;
    $job->description = $description;
    $job->active      = $active;

    if (!$jobService->updateJob($job)) {
        header('Location: index.php?status=error');
        exit;
    }

    header('Location: index.php?status=success');
    exit;
}

include __DIR__ . "/src/includes/header.php";
include __DIR__ . "/src/includes/form.php";
include __DIR__ . "/src/includes/footer.php";