<?php
/* I might use $argc and $argv here when necessary. */

$_SERVER['PATH_INFO'] = "/downloadCompaniesAndPrices";
$_SERVER['REQUEST_URI'] = $_SERVER['PATH_INFO'];

$_SERVER["DOCUMENT_ROOT"] = realpath(__DIR__ . '/..');

require_once($_SERVER["DOCUMENT_ROOT"] . '/api/public/index.php');