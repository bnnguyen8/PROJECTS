# Install Laravel with Docker 🐳

Execute the following commands to install Laravel with Docker.

```bash
$ mkdir -p src
$ docker compose build
$ docker compose up -d
$ docker compose exec app composer create-project --prefer-dist laravel/laravel .
$ docker compose exec app php artisan key:generate
$ docker compose exec app php artisan storage:link
$ docker compose exec app chmod -R 755 storage bootstrap/cache
$ docker compose exec app php artisan migrate
```

### OR

```bash
$ make install
```

This repositry is a fork from https://github.com/ucan-lab/docker-laravel/wiki and I customed it to my needs.
