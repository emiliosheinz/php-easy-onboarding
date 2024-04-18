tests:
	composer dump-autoload
	./vendor/bin/phpunit --coverage-html ./coverage
