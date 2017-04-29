<?php

if (!isset($argv[1]))
	exit("\nError. Sample usage: php $argv[0] 2017-04-31\n\n");

$date = $argv[1];

$_SERVER['PATH_INFO'] = "/downloadCompaniesAndPricesByDate/{$date}";
$_SERVER['REQUEST_URI'] = $_SERVER['PATH_INFO'];

$_SERVER["DOCUMENT_ROOT"] = realpath(__DIR__ . '/..');

require_once($_SERVER["DOCUMENT_ROOT"] . '/api/public/index.php');