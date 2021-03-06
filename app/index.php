<?php

require __DIR__ . "/vendor/autoload.php";

use \Root\Html\Services\JobService;
use \Root\Html\Services\PaginationService;

$search = filter_input(INPUT_GET, 'search');
$status = filter_input(INPUT_GET, 'active');

$conditions = [
    strlen($search) ? "title LIKE '%$search%'" : null,
    strlen($status) ? "active = '$status'" : null,
];

$conditions = array_filter($conditions);

$where = implode(' AND ', $conditions);

$jobService = new JobService();

$jobsQuantity = $jobService->getJobsQuantity($where);

$currentPage = $_GET['page'] ?? 1;

$paginationService = new PaginationService($jobsQuantity, $currentPage, $limit = 5);

$jobs = $jobService->getJobs($where, $order = null, $paginationService->getLimit());

include __DIR__ . "/src/includes/header.php";
require __DIR__ . "/src/includes/listing.php";
include __DIR__ . "/src/includes/footer.php";