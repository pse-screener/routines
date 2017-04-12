<?php

include "../../SMS/Sms.php";

$sms = new Sms;
print "Set device: " . $sms->setDevice('/dev/ttyUSB2') . "\n";
print "Open device: " . $sms->openDevice() . "\n";
print "Set baud rate: " . $sms->setBaudRate(115200) . "\n";
print "Sent message: " . $sms->sendSMS('+639332162333', 'The message.');
print "Device closed: " . $sms->closeDevice();