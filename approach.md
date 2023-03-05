The task looks pretty simple, so I'll do next things:

1. Create Dockerfile, docker-compose file with PHP 8.1, nginx and redis (it would be nice to cache calculations). We do not need any RDBMS for now.
2. I'll use [Symfony skeleton](https://symfony.com/doc/current/setup.html) - it is a default choice because of its DI and the possibility of adding more Symfony components
if it will be needed.
3. There will be one Controller with only one GET endpoint, which will require two distances with unit types (floats)
 and return's unit type as query params. The endpoint will return a JSON response.
4. Validation rules: it will work with negative numbers as well as with positive, but only with 2 types of units: METERS or YARDS
5. It Would be nice to cache the results of calculating to Redis and check for it in Controller.
6. I see the opportunity for two types of tests: the unit for service that will calculate sum, and feature one for controller as well.
