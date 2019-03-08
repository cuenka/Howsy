# Howsy test
Test for Howsy

Instructions:
This test has been developed with PHP 7.2 and MySql 5.6
The command below could change depending of machine and set up.

**Steps:**
```
php composer install
```

* set up database on .env like: 
```
DATABASE_URL=mysql://howsy:howsy@127.0.0.1:3306/howsy
GOOGLE_MAPS_API_KEY={Your key}
```
Also update phpunit.xml.dist with the right DB, Line 15
In order to create Database, create migration and add fixtures run:
Updated: Before I used schema, migrations offer solutions to potential future problems.
https://stackoverflow.com/questions/23339711/doctrine-schema-update-or-doctrine-migrations

```
php bin/console doctrine:database:create
php bin/console make:migration
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
```

I used minimum css and JS for this test but I used standard set up encore.
https://symfony.com/doc/4.0/frontend/encore/installation.html
In order to see the up running properly execute the following comands:
```
yarn install
yarn add @symfony/webpack-encore --dev
yarn add sass-loader@^7.0.1 node-sass --dev
yarn add bootstrap
yarn add popper.js
yarn add jquery
yarn encore dev
```


Code standards: I followed https://cs.symfony.com/

Extra Documentation for API: Nelmio https://github.com/nelmio/NelmioApiDocBundle

**More information**
I created some unit tests, It does not cover all scenarios
but for the purpose of the test I believe is Ok.

