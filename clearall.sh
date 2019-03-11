#! /bin/sh
php -dmemory_limit=4G bin/magento setup:upgrade
#php bin/magento setup:di:compile
#php bin/magento setup:static-content:deploy -f
php bin/magento cache:clean
php bin/magento cache:flush
php bin/magento indexer:reindex
