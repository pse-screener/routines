<?php
/* Deletes old records. Default to more than 30 days. */

$_SERVER['PATH_INFO'] = "/deleteOldRecords";
$_SERVER['REQUEST_URI'] = $_SERVER['PATH_INFO'];

$_SERVER["DOCUMENT_ROOT"] = realpath(__DIR__ . '/..');

require_once($_SERVER["DOCUMENT_ROOT"] . '/api/public/index.php');