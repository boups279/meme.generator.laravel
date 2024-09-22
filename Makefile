deploy:
	ssh o2switch 'cd ~/sites/meme-generator.boups.tech/meme.generator.laravel && git pull origin master && make install'

install: vendor/autoload.php .env public/storage public/build/manifest.json
	php artisan cache:clear
	php artisan migrate

.env:
	cp .env.example .env
	php artisan key:generate

public/storage:
	php artisan storage:link

vendor/autoload.php: composer.lock
	composer install
	touch vendor/autoload.php

public/build/manifest.json:
	npm i
	npm run build