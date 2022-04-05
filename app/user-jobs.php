<?php

require_once __DIR__ . '/vendor/autoload.php';

use \Root\Html\Session\Login;
use \Root\Html\Services\JobService;
use \Root\Html\utils\SearchComponent;
use \Root\Html\Services\PaginationService;

Login::requireLogin();

$loggedUser = Login::getLoggedInUser();

if(!$loggedUser) {
    header('Location: login.php');
}

$search = filter_input(INPUT_GET, 'search');
$status = filter_input(INPUT_GET, 'active');

$userId = $loggedUser['id'];

$conditions = [
    strlen($search) ? "title LIKE '%$search%'" : null,
    strlen($status) ? "active = '$status'" : null,
    'user_id = ' . "$userId"
];

$conditions = array_filter($conditions);

$where = implode(' AND ', $conditions);

$jobService = new JobService();
$jobsQuantity = $jobService->getJobsQuantity($where);

$currentPage = $_GET['page'] ?? 1;

$paginationService = new PaginationService($jobsQuantity, $currentPage, $limit = 5);

$jobs = $jobService->getJobs($where, $order = null, $paginationService->getLimit());

include __DIR__ . "/src/includes/header.php";
include __DIR__ . "/src/includes/list-user-jobs.php";
include __DIR__ . "/src/includes/footer.php";