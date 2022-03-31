<?php
require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/src/utils/validations.php";

use \Root\Html\Entity\Job;
use \Root\Html\Services\JobService;

if (!hasIdIntoUrlParams()) {
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

if (!$jobService->deleteJob($job->id)) {
    header('Location: index.php?status=error');
    exit;
}

header('Location: index.php?status=success');
exit;