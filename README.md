## Routines

```
* 9-11 * * 1-5    /usr/bin/php /var/www/pmorcilladev/pse_screener/routines/downloadCompaniesAndPrices.php
* 9-11 * * 1-5    /usr/bin/php /var/www/pmorcilladev/pse_screener/routines/harvestDownloadedCompaniesAndPrices.php
* 9-11 * * 1-5    /usr/bin/php /var/www/pmorcilladev/pse_screener/routines/materializeRawDataPerMinute.php
# > /dev/null 2>&1

0-3 12 * * 1-5    /usr/bin/php /var/www/pmorcilladev/pse_screener/routines/downloadCompaniesAndPrices.php
0-4 12 * * 1-5    /usr/bin/php /var/www/pmorcilladev/pse_screener/routines/harvestDownloadedCompaniesAndPrices.php
0-5 12 * * 1-5    /usr/bin/php /var/www/pmorcilladev/pse_screener/routines/materializeRawDataPerMinute.php
# > /dev/null 2>&1

30-59 13 * * 1-5   /usr/bin/php /var/www/pmorcilladev/pse_screener/routines/downloadCompaniesAndPrices.php
30-59 13 * * 1-5   /usr/bin/php /var/www/pmorcilladev/pse_screener/routines/harvestDownloadedCompaniesAndPrices.php
30-59 13 * * 1-5   /usr/bin/php /var/www/pmorcilladev/pse_screener/routines/materializeRawDataPerMinute.php
# > /dev/null 2>&1

* 14 * * 1-5   /usr/bin/php /var/www/pmorcilladev/pse_screener/routines/downloadCompaniesAndPrices.php
* 14 * * 1-5   /usr/bin/php /var/www/pmorcilladev/pse_screener/routines/harvestDownloadedCompaniesAndPrices.php
* 14 * * 1-5 /usr/bin/php /var/www/pmorcilladev/pse_screener/routines/materializeRawDataPerMinute.php
# /dev/null 2>&1

0-33 15 * * 1-5   /usr/bin/php /var/www/pmorcilladev/pse_screener/routines/downloadCompaniesAndPrices.php
0-34 15 * * 1-5   /usr/bin/php /var/www/pmorcilladev/pse_screener/routines/harvestDownloadedCompaniesAndPrices.php
0-35 15 * * 1-5   /usr/bin/php /var/www/pmorcilladev/pse_screener/routines/materializeRawDataPerMinute.php
# /dev/null 2>&1

36 15 * * 1-5      /usr/bin/php /var/www/pmorcilladev/pse_screener/routines/materializeForPerCompanyPerTradingDay.php

# Send SMS alert at the end of the trading day.
37 15 * * 1-5      /usr/bin/php /var/www/pmorcilladev/pse_screener/routines/sendDailyAlertsToSubscribers.php

# Alert the administrator if the load is about to expire or the number of sms sent is about to reach its allowed.
38 15 * * 1-5      /usr/bin/php /var/www/pmorcilladev/pse_screener/routines/alertAdministratorLoadStatus.php
```

#### After cloning create a folder with structure like this

1. /var/log/pse_monitor/raw_data/
2. /var/log/pse_monitor/raw_data/processed
3. /var/log/pse_monitor/raw_data/perCompany/
4. sudo chown -R <your user> /var/log/pse_monitor/raw_data/
5. Then run the routines in order below.


#### Normal order of routines:
1. downloadCompaniesAndPrices.php
2. harvestDownloadedCompaniesAndPrices.php
3. materializeRawDataPerMinute.php
4. materializeForPerCompanyPerTradingDay.php

#### If there are lacking days
1. downloadCompaniesAndPricesByDate.php
2. harvestDownloadedCompaniesAndPricesPerCompany.php
3. materializeRawDataPerMinute.php
4. materializeForPerCompanyPerTradingDay.php

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

#### To check and stop periodic messages
```
AT^CURC? Current setting of periodic status messages
AT^CURC=? See what you possible values are
AT^CURC=0 turn off periodic status messages
```