#!/bin/sh

cd ..
rm WPStatistic.zip
zip -r WPStatistic.zip WordpressStatistic -x *.git*
cd WordpressStatistic
