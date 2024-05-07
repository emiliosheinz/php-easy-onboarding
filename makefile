tests:
	composer dump-autoload
	./vendor/bin/phpunit --coverage-html ./coverage

phinx:
	docker exec app php vendor/bin/phinx $(filter-out $@,$(MAKECMDGOALS))