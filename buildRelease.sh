#!/bin/sh

cd ..
rm wp-statistic.zip
zip -r wp-statistic.zip wp-statistic -x *.git*
cd wp-statistic
