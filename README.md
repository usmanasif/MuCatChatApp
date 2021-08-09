MuCat: Messanger app bases on websockets
==============================================



------------------------------------------------------------------------
Pre-requisite
-----
- phpenv / phpbrew
- php -v 8.0
- Mysql -v 14.14
- nvm -v 0.38.0
- npm -v 16.0
- yarn
- composer


**Phpenv**  is a tool to help simplify the management of multiple PHP custom build installations.


It automatically creates and manages a php environment for your projects, as
well as adds/removes packages from your `composer.json` as you
install/uninstall packages. 


-----------------------------------------------------------------------
Setup
-----

Login into your mysql shell:

    $ sudo su - & mysql 
create database:

    mysql: create database mucat_chat;


------------------------------------------------------------------------

Create .env file using content of .env.example and update credentials where required.

    $ touch .env & .env << .env.example

.env file changes

    APP_NAME=MuCat
    APP_ENV=local
    APP_KEY=base64:U89v4s2Oec4Ta+bgrGFLNHmxxv+Ecw100kPsvApPRgU=
    APP_DEBUG=true
    APP_URL=http://localhost
    
    LOG_CHANNEL=stack
    LOG_LEVEL=debug
    
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=mucat_chat
    DB_USERNAME=root
    DB_PASSWORD=rootroot
    
    BROADCAST_DRIVER=redis
    CACHE_DRIVER=file
    FILESYSTEM_DRIVER=local
    QUEUE_CONNECTION=redis
    SESSION_DRIVER=database
    SESSION_LIFETIME=120
    
    MEMCACHED_HOST=127.0.0.1
    
    REDIS_HOST=127.0.0.1
    REDIS_PORT=6379
    REDIS_PREFIX=""


you can generate your own key via 
    $ php artisan key:generate


Install all dependencies locked in composer.lock

    $ composer install

Install node dependencies

    $ npm install

Precompile assets

    $ npm run dev

for development 

    $ npm run watch

-------------------------------------------------------------------------

Run Server
----------

Migrate database to load schema changes

    $ php artisan migrate

Run echo server

    $ laravel-echo-server start

Start laravel queue listener

    $ php artisan queue:listen --daemon

-------------------------------------------------------------------------
Extras
------

To run test suite

    $ php artisan test

---------------------------------------------------------------------------

Deployment commands
-------------------

Nginx with reverse proxy for laravel echo server

````
location /socket.io {
	    proxy_pass http://domain:6001; #could be localhost if Echo and NginX are on the same box
	    proxy_http_version 1.1;
	    proxy_set_header Upgrade $http_upgrade;
	    proxy_set_header Connection "Upgrade";
	}

````


Performance Tweaking
--------------------

Mysql

Enable queue cache
    $ mysql > SET GLOBAL query_cache_size = 40000;

Increase MAX Number of connection

    $ nano $MYSQL_HOME/my.cnf

    max_connections = 400


**Switch Driver to RabitMQ**

To increase concurrency and performance switch laravel queue and cache driver  to
RabitMQ. RabitMQ support multiple nodes, load balancing and improved message broking.


*Pending setup*
