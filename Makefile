fix-cs:
	./tools/php-cs-fixer.phar fix

test:
	./vendor/bin/php-cs-fixer fix --diff --dry-run
