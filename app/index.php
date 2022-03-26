<?php

require __DIR__ . "/vendor/autoload.php";

use \Root\Html\Services\JobService;

$search = filter_input(INPUT_GET, 'search');
$jobService = new JobService();

$where = strlen($search) ? "title LIKE '%$search%'" : null;

$jobs = $jobService->getJobs($where);

include __DIR__ . "/src/includes/header.php";
require __DIR__ . "/src/includes/listing.php";
include __DIR__ . "/src/includes/footer.php";