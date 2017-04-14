<?php

$device = '/dev/ttyUSB2';

$desc = array(
    0 => array('pipe', 'r'), // 0 is STDIN for process
    1 => array('pipe', 'w'), // 1 is STDOUT for process
    2 => array('file', '/tmp/php-serial_error.txt', 'a') // 2 is STDERR for process
);

$proc = proc_open('stty -F $device', $desc, $pipes);

// print_r($pipes);

fclose($pipes[0]);
fclose($pipes[1]);

$retVal = proc_close($proc);

// print "proc_close(): $retVal\n";


// Open the device
$fopen = fopen($device, 'r+');
// print "fopen(): $fopen\n";

////////////////////////////////////////////////////////
// set the device
$desc = array(
    0 => array('pipe', 'r'), // 0 is STDIN for process
    1 => array('pipe', 'w'), // 1 is STDOUT for process
    2 => array('file', '/tmp/php-serial_error.txt', 'a') // 2 is STDERR for process
);

$proc = proc_open('stty -F $device 115200', $desc, $pipes);

// print_r($pipes);

fclose($pipes[0]);
fclose($pipes[1]);

if (isset($pipes[2]))
	fclose($file);

$retVal = proc_close($proc);

// print "proc_close(): $retVal\n";
////////////////////////////////////////////////////////

stream_set_timeout($fopen, 20);

// $bytesWritten = fwrite($fopen, "ATI\r");
// print "Bytes Written: $bytesWritten\n";
// print "Written ATI\n";

sleep(5);

stream_set_blocking($fopen, false);

/*$content = "";  $i = 0;

do {
	$content .= fread($fopen, 128);
	print "Sigeg basa...\n";
} while (($i += 128) == strlen($content));

print "Content: $content\n"; $content = "";*/

// okay ni sya
$content = "";  $i = 0;
$bytesWritten = fwrite($fopen, "AT+CMGF=1\r");
sleep(5);
do {
	$content .= fread($fopen, 128);
} while (($i += 128) == strlen($content));
print var_dump(trim($content));


$content = "";  $i = 0;
$bytesWritten = fwrite($fopen, "AT+CMGS=\"+639332162333\"\r");
// $bytesWritten = fwrite($fopen, "AT+CMGS=\"+639472609815\"\r");
sleep(5);
// $bytesWritten = fwrite($fopen, "AT+CMGS=\"+639192278985\"\r");
do {
	$content .= fread($fopen, 128);
} while (($i += 128) == strlen($content));
print var_dump(trim($content));

$content = "";  $i = 0;
$bytesWritten = fwrite($fopen, "Test message." . chr(26) . "\r");
sleep(5);
do {
 	$content .= fread($fopen, 128);
 } while (($i += 128) == strlen($content));
print var_dump(trim($content));

fclose($fopen);
