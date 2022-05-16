# Sample Project

Author: Dileesha Nayanajth (github: Dileesha-dev)

### Development Instructions

Migrate and seed the database
```
php artisan migrate:refresh
php artisan db:seed
```

Install composer packages
```
composer install
```

Install the local development packages
```
npm i && npm run watch
```

Generate API documentation
```
php artisan scribe:generate
```

### API Usage

```
Find docs @: localhost:port/docs
```
```
For postman collection run: php artisan export:postman
```