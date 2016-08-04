# PHP Data Interpolation

Data Interpolation class

Today the number of assertions per test is something set by company standarts. Personally, I have worked in companies that encouraged only one assertion per test. However, lately, I worked in companies that encouraged more than one assertion per test.

In the test of this class I have taken the approach of more than one assertion per test.


## How to use it

to run this class you need php and composer installed

```
git clone https://github.com/felipegusmao/php-data-interpolation.git

cd php-data-interpolation

composer install
```

## How to run cli-demo

```
# navigate to the root of the project
php cli-demo.php
```

## To run the tests

just run

```
#For unit tests
vendor/bin/phpunit

#For code coverage
vendor/bin/phpunit --coverage-html coverage
```


