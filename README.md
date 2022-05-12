<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Kelompok Kami
- Muhammad Prasetyo Nugroho (200535626872)
- Titto Mahogany Attaraqie  (200535626830)


## Tentang Alaska
Website Alaska adalah sebuah website e-commerce yang berfokus pada penawaran jasa editing video, foto, dan animasi. Website ini bertujuan untuk mempromosikan skill Editing orang-orang dan mengembangkan potensinya serta mendapatkan income dengan sistem jual beli jasa.
<br>
Selain itu, banyak masyarakat di Indonesia yang cerdas dan penuh potensi namun sayang belum mendapatkan mediasi yang baik, sehingga diharapkan dengan adanya website ini dapat membantu masyarakat luas khususnya dibidang tersebut.



## Before Run This Project

<h4>Run this following command in terminal: </h4>


```
composer install
```

then: 
```
npm install
```

## To Run This Project

<h4>Create the database </h4> 

Create a database with the name ```alaska_db```



Duplicate .env.example and rename with .env, then fill in ``DB_DATABASE`` with ```alaska_db``` and fill in the rest according to your database settings.
```
DB_DATABASE=alaska_db
```

<h3>Run this following command in terminal: </h3> 


```
npm run dev
```

Migrate the database: 
```
php artisan migrate
```

then:
```
php artisan serve
```