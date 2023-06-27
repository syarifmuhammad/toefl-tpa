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

how to push
```
git add .
git commit -m <your comment>
git push
```

## structure folder
- resources -> for view
- app/Http -> for controller
- app/Models -> for models
- routes/ -> for routes
  - web.php
  - auth.php 
- public/assets -> for assets

## important link
- [figma](https://www.figma.com/file/fRx0OHk1H60POgjbMtu9dG/Untitled?type=design&node-id=0-1&mode=design&t=lTNaUaKbnl115bKY-0)
- [class diagram](https://drive.google.com/file/d/1IEbZgJyzN-ruYdEXGXN0e1Qg9MVTiiGL/view)



## screenshots
![dashboard](/screenshots/dashboard.png)