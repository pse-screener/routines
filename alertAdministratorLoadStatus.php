<?php
/* Use: To alert SMS Load status. */

$_SERVER['PATH_INFO'] = "/alertAdministratorLoadStatus";
$_SERVER['REQUEST_URI'] = $_SERVER['PATH_INFO'];

$_SERVER["DOCUMENT_ROOT"] = realpath(__DIR__ . '/..');

require_once($_SERVER["DOCUMENT_ROOT"] . '/api/public/index.php');