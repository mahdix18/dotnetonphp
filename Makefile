#
# Makefile for nosetests
#

all:
	vendor/bin/phpunit --configuration=./tests/configs/phpunit.xml 
	rm -rf /tmp/*

collections:
	vendor/bin/phpunit --group collections --configuration=./tests/configs/phpunit.xml

core:
	vendor/bin/phpunit --colors --group core --configuration=./tests/configs/phpunit.xml

io:
	vendor/bin/phpunit --group io --configuration=tests/configs/phpunit.xml
	rm -rf /tmp/*

xml:
	vendor/bin/phpunit --group xml --configuration=./tests/configs/phpunit.xml

coverage:
	vendor/bin/phpunit --configuration=./tests/configs/phpunit-coverage.xml

doc:
	phpdoc -d src/ -t docs/