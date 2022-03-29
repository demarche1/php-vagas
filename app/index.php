<?php

require __DIR__ . "/vendor/autoload.php";

use \Root\Html\Services\JobService;
use Root\Html\Services\PaginationService;

$search = filter_input(INPUT_GET, 'search');
$status = filter_input(INPUT_GET, 'active');
$jobService = new JobService();

$conditions = [
    strlen($search) ? "title LIKE '%$search%'" : null,
    strlen($status) ? "active = '$status'" : null
];

$conditions = array_filter($conditions);

$where = implode(' AND ', $conditions);

$jobsQuantity = $jobService->getJobsQuantity($where);

$currentPage = $_GET['page'] ?? 1;

$paginationService = new PaginationService($jobsQuantity, $currentPage, 3);

$jobs = $jobService->getJobs($where, null, $paginationService->getLimit());

include __DIR__ . "/src/includes/header.php";
require __DIR__ . "/src/includes/listing.php";
include __DIR__ . "/src/includes/footer.php";