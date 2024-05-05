tests:
	composer dump-autoload
	./vendor/bin/phpunit --coverage-html ./coverage

new-migration:
	docker exec app php vendor/bin/phinx create $(filter-out $@,$(MAKECMDGOALS))