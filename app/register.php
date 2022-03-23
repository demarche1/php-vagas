<?php


require_once __DIR__ . "/vendor/autoload.php";

use \Root\Html\Entity\Job;
use \Root\Html\Services\JobService;

function isValidRegister()
{
    $title       = filter_input(INPUT_POST, 'title');
    $description = filter_input(INPUT_POST, 'description');
    $active      = filter_input(INPUT_POST, 'active');

    return
        isset($title)           &&
        isset($description)     &&
        isset($active)          &&
        is_string($title)       &&
        is_string($description) &&
        is_string($active);
}



if (isValidRegister()) {
    $job              = new Job();
    $job->title       = $title;
    $job->description = $description;
    $job->active      = $active;

    $jobService = new JobService();
    $jobService->register($job);

    die(isValidRegister());
}


include __DIR__ . "/src/includes/header.php";
include __DIR__ . "/src/includes/form.php";
include __DIR__ . "/src/includes/footer.php";
