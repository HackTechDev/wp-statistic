#!/bin/sh

cd ..
rm WPStatistic.zip
zip -r WPStatistic.zip WP-Statistic -x *.git*
cd WP-Statistic
