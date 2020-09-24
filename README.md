<p align="center"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<img alt="GitHub language count" src="https://img.shields.io/static/v1?label=version&message=7.5.2">
<a href="https://dryaslibrary.herokuapp.com/"><img alt="Website" src="https://img.shields.io/website?url=https://dryaslibrary.herokuapp.com/"></a>
<img alt="GitHub deployments" src="https://img.shields.io/github/deployments/rdp77/dryas-library/dryaslibrary">
<img alt="GitHub repo size" src="https://img.shields.io/github/repo-size/rdp77/dryas-library">
<a href="https://github.com/rdp77/dryas-library/blob/master/LICENSE"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Settings Environment

Copy the <b>.env.example</b> file and rename it to <b>.env</b> then run
```
    php artisan key:generate
```

## Import Table And Run Seeder

For All Table And Seeder: 
```
    php artisan migrate:refresh --seed
```

Only Table: 
```
    php artisan migrate
```

Only Seeder: 
```
    php artisan db:seed
```

For Specific Seeder: 
```
    php artisan db:seed --class=NameSeeder
```

## User Management

Admin: 
```
    username: admin@admin.com
    password: 123123123
```

User: 
```
    username: user@user.com
    password: 12345678
```