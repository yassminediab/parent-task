# Parent Code Challenge

We have two providers collect data from them in json files we need to read and make some filter operations on them to get the result


## Requirement 
docker , docker-compose

## Technologies 
Laravel 


## Installation

- clone project

```bash
git clone https://github.com/yassminediab/parent-task.git
```
- build docker as administrator

```bash
docker-compose build
```

- Serve Project

```bash
docker-compose up
```

```bash
docker exec parent_php_fpm_container composer install
```


```bash
docker exec parent_php_fpm_container chmod 777 storage -R
```


- Open project on [localhost:7070](localhost:7070)

- Run unit testing 
```bash
docker exec  parent_php_fpm_container ./vendor/bin/phpunit
```

- run project
```bash
http://localhost:7070/api/v1/users?provider=DataProviderX&currency=AED&max_amount=100&min_amount=4&statusCode=authorised
```


