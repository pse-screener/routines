<?php
/* This is run if there are lacking date like if wasn't able to pull the data from the upstream. */


/* I might use $argc and $argv here when necessary. */

$_SERVER['PATH_INFO'] = "/harvestDownloadedCompaniesAndPricesPerCompany";
$_SERVER['REQUEST_URI'] = $_SERVER['PATH_INFO'];

$_SERVER["DOCUMENT_ROOT"] = realpath(__DIR__ . '/..');

require_once($_SERVER["DOCUMENT_ROOT"] . '/api/public/index.php');