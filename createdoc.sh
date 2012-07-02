#!/bin/sh
phpdoc -d application/models -d application/controllers -d application/helpers -i application/helpers/markdown_helper.php -t docs
