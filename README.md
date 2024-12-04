<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Deploy the Project

1 - Clone project from GitHub 

    git clone https://github.com/vvbatura/test_nuxgames.git

2 - Create env file from "env.example"

    copy file "env.example" and paste with name "env"

3 - Generate key for APP

    php artisan key:generate

4 - Create tables in DB

    php artisan migrate

5 - Start server project

    php artisan serve
