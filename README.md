# Routines

```
$ crontab -l
#
# m h  dom mon dow   command
# */1 9-16 * * 1-5 /usr/bin/curl http://localhost/downloadAllCompanies > /dev/null 2>&1

* 9-11 * * 1-5 /usr/bin/curl http://localhost/downloadCompaniesAndPrices
0-2 12 * * 1-5 /usr/bin/curl http://localhost/downloadCompaniesAndPrices
* 13-14 * * 1-5 /usr/bin/curl http://localhost/downloadCompaniesAndPrices
0-32 15 * * 1-5 /usr/bin/curl http://localhost/downloadCompaniesAndPrices
* 9-15 * * 1-5 /usr/bin/curl http://localhost/materializeRawDataPerMinute
* 9-15 * * 1-5 /usr/bin/curl http://localhost/materializeForPerCompanyDaily

# EOD of course is always after the above.
30 16 * * 1-5 /usr/bin/curl http://localhost/performEOD > /dev/null 2>&1
```

#### After cloning create a folder with structure like this

1. /var/log/pse_monitor/raw_data/
2. /var/log/pse_monitor/raw_data/processed
3. sudo chown -R <your user> /var/log/pse_monitor/raw_data/
4. Then run the routines in order below.


#### Order of the routines:
1. downloadCompaniesAndPrices.php - This gets the data from the upstream server and put into the raw data.
2. harvestDownloadedCompaniesAndPrices.php - It harvests downloaded data.
3. materializeRawDataPerMinute.php - materializes the data to make it usuable.

Actually I do not use the above http request anymore but run it through php cli for security reasons.

#### References

1. https://routerunlock.com/send-command-usb-modem-using-putty/
2. https://www.diafaan.com/sms-tutorials/gsm-modem-tutorial/at-cmgs-text-mode/
3. https://gonzalo123.com/2011/03/21/howto-sendread-smss-using-a-gsm-modem-at-commands-and-php/
4. https://www.sitepoint.com/proc-open-communicate-with-the-outside-world/
5. http://www.smssolutions.net/tutorials/gsm/sendsmsat/

#### To connect to USB
1. https://brunomgalmeida.wordpress.com/2012/04/06/send-at-commands-to-usb-modem/
2. https://bugs.launchpad.net/ubuntu/+source/gtkterm/+bug/949597

#### To get the device name
$ dmesg | grep tty

#### To get access to the device
```
$ sudo adduser <your_user> dialout
$ sudo chmod a+rw /dev/ttyUSB(X)
```

#### Sample SMS messaging

The AT+CMGS command sends an SMS message to a GSM phone. In text mode this command is less powerful than in PDU mode but it is certainly easier to use.

Parameters
```
<CR> = ASCII character 13
<CTRL-Z> = ASCII character 26
<mr> = Message Reference

AT+CMGF=1
OK
AT+CMGS="+639332162333"
> This is the text message.→
+CMGS: 198
OK
```

#### To check and stop periodic messages
```
AT^CURC? Current setting of periodic status messages
AT^CURC=? See what you possible values are
AT^CURC=0 turn off periodic status messages
```