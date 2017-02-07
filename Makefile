
install:
	composer --no-interaction --prefer-source install

update:
	composer update

test:
	vendor/bin/phpunit tests

