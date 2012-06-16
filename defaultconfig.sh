#!/bin/sh
echo "Restoring all default configuration files..."
echo "copying .htaccess.default to .htaccess"
cp .htaccess.default .htaccess
echo "copying application/config/config.php.default to application/config/config.php"
cp application/config/config.php.default application/config/config.php
echo "copying application/config/database.php.default to application/config/database.php"
cp application/config/database.php.default application/config/database.php
