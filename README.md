# Getting started

requirement:
- php
- composer (package manager for php)
- nodejs (for run npm)
- xampp (for server database)

``
before you run command below you need to start database server and create new database with name "laravel"
``


```bash
gh repo clone syarifmuhammad/toefl-tpa 
cd toefl-tpa
composer install
cp .env.example .env
php artisan migrate
php artisan key:generate
php artisan serve
```

in new terminal run
```bash
npm install
npm run dev
```


## structure folder
resources -> for view
app/Http -> for controller
app/Models -> for models
