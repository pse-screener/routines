# Routines

```
$ crontab -l
# Edit this file to introduce tasks to be run by cron.
#
# Each task to run has to be defined through a single line
# indicating with different fields when the task will be run
# and what command to run for the task
#
# To define the time you can provide concrete values for
# minute (m), hour (h), day of month (dom), month (mon),
# and day of week (dow) or use '*' in these fields (for 'any').#
# Notice that tasks will be started based on the cron's system
# daemon's notion of time and timezones.
#
# Output of the crontab jobs (including errors) is sent through
# email to the user the crontab file belongs to (unless redirected).
#
# For example, you can run a backup of all your user accounts
# at 5 a.m every week with:
# 0 5 * * 1 tar -zcf /var/backups/home.tgz /home/
#
# For more information see the manual pages of crontab(5) and cron(8)
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
3. sudo chown -R /var/log/pse_monitor/raw_data/
4. Then run the routines in order below.


#### Order of the routines:
1. downloadCompaniesAndPrices.php - This gets the data from the upstream server and put into the raw data.
2. harvestDownloadedCompaniesAndPrices.php - It harvests downloaded data.
3. materializeRawDataPerMinute.php - materializes the data to make it usuable.

Actually I do not use the above http request anymore but run it through php cli for security reasons.

### References

1. https://routerunlock.com/send-command-usb-modem-using-putty/
2. https://www.diafaan.com/sms-tutorials/gsm-modem-tutorial/at-cmgs-text-mode/
3. https://gonzalo123.com/2011/03/21/howto-sendread-smss-using-a-gsm-modem-at-commands-and-php/
4. https://www.sitepoint.com/proc-open-communicate-with-the-outside-world/
5. http://www.smssolutions.net/tutorials/gsm/sendsmsat/

### To connect to USB
1. https://brunomgalmeida.wordpress.com/2012/04/06/send-at-commands-to-usb-modem/
2. https://bugs.launchpad.net/ubuntu/+source/gtkterm/+bug/949597

### To get the device name
$ dmesg | grep tty

### To monitor the device and show output. This can be used with the php script being ran.
$ cat /dev/{the_device}

### Sample SMS messaging

The AT+CMGS command sends an SMS message to a GSM phone. In text mode this command is less powerful than in PDU mode but it is certainly easier to use.

Parameters
<CR> = ASCII character 13
<CTRL-Z> = ASCII character 26
<mr> = Message Reference

AT+CMGF=1
OK
AT+CMGS="+639332162333"
> This is the text message.→
+CMGS: 198
OK