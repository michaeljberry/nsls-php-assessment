<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

## Steps to run the application

- clone the repository by running:

```
git clone repo-link
```

- create a database name "assessment_api"
- build the application by running the following commands:

```
composer install

cp .env.example .env
```

- update the database credentials (host, username, password) in .env file depending on your running database services
- once done, continue on building the application by running:

```
php artisan key:generate
chmod 0777 -R bootstrap
chmod 0777 -R storage

php artisan migrate

php artisan serve
```

- you can now access the application thru `http://localhost:8000/`
- api request

```
curl -X GET -H 'Authorization: Bearer [api_token]' -H 'Content-Type: application/json' 'http://localhost:8000/api/weather/office/forecast'
```