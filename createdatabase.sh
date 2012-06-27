#!/bin/bash
echo "This script will setup the goftogo database. It will only work if no user goftogo exists yet."
echo "You will need your MySQL root password."
read -p  "Press ENTER to continue"
echo "creating user..."
mysql -u root -p < database/init.sql
echo "creating tables..."
mysql goftogo -u goftogo < database/tables.sql
echo "entering example data..."
mysql goftogo -u goftogo < database/data.sql
