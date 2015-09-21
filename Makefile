
install:
	composer --no-interaction --prefer-source --dev install

update:
	composer update

test:
	phpunit tests

