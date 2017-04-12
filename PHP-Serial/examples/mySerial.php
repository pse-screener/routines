<?php

$device = '/dev/ttyUSB2';

$desc = array(
    0 => array('pipe', 'r'), // 0 is STDIN for process
    1 => array('pipe', 'w'), // 1 is STDOUT for process
    2 => array('file', '/tmp/php-serial_error.txt', 'a') // 2 is STDERR for process
);

$proc = proc_open('stty -F $device', $desc, $pipes);

print_r($pipes);

fclose($pipes[0]);
fclose($pipes[1]);

$retVal = proc_close($proc);

print "proc_close(): $retVal\n";


// Open the device
$fopen = fopen($device, 'r+');
print "fopen(): $fopen\n";
// $streamSetBlocking = stream_set_blocking($fopen, false) . "\n";
// print "stream_set_blocking(): $treamSetBlocking\n";

////////////////////////////////////////////////////////
// set the device
$desc = array(
    0 => array('pipe', 'r'), // 0 is STDIN for process
    1 => array('pipe', 'w'), // 1 is STDOUT for process
    2 => array('file', '/tmp/php-serial_error.txt', 'a') // 2 is STDERR for process
);

$proc = proc_open('stty -F $device 115200', $desc, $pipes);

print_r($pipes);

fclose($pipes[0]);
fclose($pipes[1]);

if (isset($pipes[2]))
	fclose($file);

$retVal = proc_close($proc);

print "proc_close(): $retVal\n";
////////////////////////////////////////////////////////


$bytesWritten = fwrite($fopen, "ATi\n\r");
print "Written ATi\n";
/*$content = fread($fopen, 128);
print "$content\n";*/
// usleep((int) (0.1 * 1000000));

$bytesWritten = fwrite($fopen, "AT+CMGF=1\n\r");
print "Written AT+CMGF=1\n";
$bytesWritten = fwrite($fopen, "AT+CMGS=\"+639332162333\"\n\r");
print "Written AT+CMGS\n";
$bytesWritten = fwrite($fopen, "I love you Megan!" . chr(26) . "\n\r");
/*usleep(2000000);
$content = fread($fopen, 1028);
print "$content\n";*/



// $bytesWritten = fwrite($fopen, "AT+CMGS=\"639332162333\"\n\r");
/*print "Written bytes: $bytesWritten\n";
$content = fread($fopen, 128);
print "$content\n";*/

// usleep((int) (0.1 * 1000000));

/*$bytesWritten = fwrite($fopen, "This is a test message from PHP-serial." . chr(26) . "\n\r");
sleep(7);
print "Written bytes: $bytesWritten\n";
$content = fread($fopen, 128);
print "$content\n";*/

/*$content = ""; $i = 0;
do {
	$content .= fread($fopen, 128);
} while (($i += 128) === strlen($content));
*/
fclose($fopen);