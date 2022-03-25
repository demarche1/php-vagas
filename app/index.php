<?php

require __DIR__ . "/vendor/autoload.php";

use \Root\Html\Services\JobService;

$jobService = new JobService();

$jobs = $jobService->getJobs();

include __DIR__ . "/src/includes/header.php";
require __DIR__ . "/src/includes/listing.php";
include __DIR__ . "/src/includes/footer.php";
