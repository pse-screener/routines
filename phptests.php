<?php

/* $date = "2016-09-21T15:20:00+08:00";
$asOf = DateTime::createFromFormat('Y-m-d', $date);
echo "Value is: ", $asOf, "\n";
*/

// $data = "2016-09-21T15:20:00+08:00";

// $match = array();
// preg_match("/(\d{4}-\d{2}-\d{2})/", $data, $match);
// preg_match("/(\d{2}:\d{2}:\d{2})/", $data, $match);


// $data = '15-Feb-2009';

// $date = DateTime::createFromFormat('j-M-Y', $data);
// echo $date->format('Y-m-d'), "\n";

// echo print_r($match, true), "\n";

// echo php_uname() . "\n";

$haystacks = array (
  'BOOT',
  'hello stackoverflow',
  'hello world',
  'foo bar bas'
);

foreach($haystacks as $haystack) {
	preg_match("/$haystack/", '^BOOT:376271,0,0,0,20', $match);
	print_r($match);
}

