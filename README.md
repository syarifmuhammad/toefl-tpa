# Getting started

requirement:
- php
- composer (package manager for php)
- nodejs (for run npm)
- xampp (for server database)

``
create new database with name "menpro"
``

```bash
gh repo clone syarifmuhammad/toefl-tpa 
cd toefl-tpa
composer install
cp .env.example .env
php artisan migrate
php artisan db:seed
php artisan key:generate
php artisan serve
```

in new terminal run
```bash
npm install
npm run dev
```

default login:
```
test@mail.com
12345678
```


## structure folder
- resources -> for view
- app/Http -> for controller
- app/Models -> for models
- routes/ -> for routes
  - web.php
  - auth.php 

## screenshots
![dashboard](/screenshots/dashboard.png)