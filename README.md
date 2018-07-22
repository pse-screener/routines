### Routines

```
# m h  dom mon dow   command
31,45,57 9 * * 1-5    /usr/bin/php /var/www/production/routines/downloadCompaniesAndPrices.php
32,46,58 9 * * 1-5    /usr/bin/php /var/www/production/routines/harvestDownloadedCompaniesAndPrices.php
33,47,59 9 * * 1-5    /usr/bin/php /var/www/production/routines/materializeRawDataPerMinute.php
35,49,55 9 * * 1-5    /usr/bin/php /var/www/production/routines/sendPerMinuteAlertsToSubscribers.php
# > /dev/null 2>&1

0,15,30,45,57 10-11 * * 1-5    /usr/bin/php /var/www/production/routines/downloadCompaniesAndPrices.php
1,16,31,46,58 10-11 * * 1-5    /usr/bin/php /var/www/production/routines/harvestDownloadedCompaniesAndPrices.php
2,17,32,47,59 10-11 * * 1-5    /usr/bin/php /var/www/production/routines/materializeRawDataPerMinute.php
0,4,19,34,49,55 10-11 * * 1-5    /usr/bin/php /var/www/production/routines/sendPerMinuteAlertsToSubscribers.php
# > /dev/null 2>&1

2 12 * * 1-5    /usr/bin/php /var/www/production/routines/downloadCompaniesAndPrices.php
3 12 * * 1-5    /usr/bin/php /var/www/production/routines/harvestDownloadedCompaniesAndPrices.php
4 12 * * 1-5    /usr/bin/php /var/www/production/routines/materializeRawDataPerMinute.php
0,6 12 * * 1-5    /usr/bin/php /var/www/production/routines/sendPerMinuteAlertsToSubscribers.php
# > /dev/null 2>&1

31,45,57 13 * * 1-5   /usr/bin/php /var/www/production/routines/downloadCompaniesAndPrices.php
32,46,58 13 * * 1-5   /usr/bin/php /var/www/production/routines/harvestDownloadedCompaniesAndPrices.php
33,47,59 13 * * 1-5   /usr/bin/php /var/www/production/routines/materializeRawDataPerMinute.php
35,49,55 13 * * 1-5    /usr/bin/php /var/www/production/routines/sendPerMinuteAlertsToSubscribers.php

# > /dev/null 2>&1

0,15,30,45,57 14 * * 1-5   /usr/bin/php /var/www/production/routines/downloadCompaniesAndPrices.php
1,16,31,46,58 14 * * 1-5   /usr/bin/php /var/www/production/routines/harvestDownloadedCompaniesAndPrices.php
2,17,32,47,59 14 * * 1-5 /usr/bin/php /var/www/production/routines/materializeRawDataPerMinute.php
0,19,34,49,55 14 * * 1-5    /usr/bin/php /var/www/production/routines/sendPerMinuteAlertsToSubscribers.php
# /dev/null 2>&1

0,15,31 15 * * 1-5   /usr/bin/php /var/www/production/routines/downloadCompaniesAndPrices.php
1,16,32 15 * * 1-5   /usr/bin/php /var/www/production/routines/harvestDownloadedCompaniesAndPrices.php
2,17,33 15 * * 1-5   /usr/bin/php /var/www/production/routines/materializeRawDataPerMinute.php
0,4,19 15 * * 1-5    /usr/bin/php /var/www/production/routines/sendPerMinuteAlertsToSubscribers.php

34 15 * * 1-5      /usr/bin/php /var/www/production/routines/materializeForPerCompanyPerTradingDay.php

# Generates the SMS alert to be sent at the end of the trading day.
35 15 * * 1-5      /usr/bin/php /var/www/production/routines/sendDailyAlertsToSubscribers.php

0 11,22  * * * /usr/bin/php /var/www/production/routines/testSms.php
```

#### After cloning create a folder with structure like this

1. /var/log/pse_monitor/raw_data/
2. /var/log/pse_monitor/raw_data/processed
3. /var/log/pse_monitor/raw_data/perCompany/
4. sudo chown -R <your user> /var/log/pse_monitor/raw_data/
5. Then run the routines in order below.


#### Normal order:
1. downloadCompaniesAndPrices.php
2. harvestDownloadedCompaniesAndPrices.php
3. materializeRawDataPerMinute.php
4. materializeForPerCompanyPerTradingDay.php

#### If there are lacking days (not current date)
1. downloadCompaniesAndPricesByDate.php
2. harvestDownloadedCompaniesAndPricesPerCompany.php
3. materializeRawDataPerMinute.php
4. materializeForPerCompanyPerTradingDay.php

#### If current date is missing
1. $ php downloadCompaniesAndPricesByCurrentDate.php
2. Following from #2 to #4 of normal orders above.

After running above scripts, run this for the alerts.
```
$ php sendDailyAlertsToSubscribers.php
```

#### Troubleshooting guides
1. If running `$ php downloadCompaniesAndPricesByCurrentDate.php`, produce similar error like this,
```
PHP Fatal error:  Uncaught exception 'UnexpectedValueException' with message 'The stream or file "/var/www/production/api/storage/logs/laravel.log" could not be opened: failed to open stream: Permission denied' in /var/www/production/api/bootstrap/cache/compiled.php:14181
```
run it as www-data. Check to run routine below.

#### To check and stop periodic messages
```
AT^CURC? Current setting of periodic status messages
AT^CURC=? Check what possible values are
AT^CURC=0 turn off periodic status messages
```
In the current setup, these don't need them anymore.

#### Texting
```
AT+CMGF=1	// Will reply OK
AT+CMGS="09332162333"	// will reply >
>Your message here.
<CTRL-Z>
+CMGS: 62

OK

or +CMS ERROR: 500
```
##### To run routine
Sample
```
sudo -u www-data /usr/bin/php /var/www/production/routines/materializeForPerCompanyPerTradingDay.php
```

##### Others
```
AT+CMGF=1
OK
AT+CMGS="3545"
> UAT30
+CMGS: 98

OK

+CMTI: "SM",14

+CMTI: "SM",15
```
