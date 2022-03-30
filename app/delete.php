<?php
require_once __DIR__ . "/vendor/autoload.php";

use \Root\Html\Entity\Job;
use \Root\Html\Services\JobService;

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

if (!$jobService->deleteJob($job->id)) {
    header('Location: index.php?status=error');
    exit;
}

header('Location: index.php?status=success');
exit;