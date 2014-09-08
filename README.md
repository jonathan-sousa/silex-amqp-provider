# silex-amqp-provider

[Amqp](http://www.amqp.org/) service provider for the [Silex](http://silex.sensiolabs.org/) framework.

This repository is strongly inspired by the work of Vitaliy Chesnokov on his [Mongo Silex Provider](https://github.com/moriony/silex-mongo-provider).

## Install via composer

Add in your ```composer.json``` the require entry for this library.
```json
{
    "require": {
        "ebichan/silex-amqp-provider": "dev-master"
    }
}
```
and run ```composer install``` (or ```update```) to download all files.

## Usage

### Service registration
```php
$app->register(new AmqpServiceProvider, array(
    'amqp.connections' => array(
        'default' => array(
            'host' => 'localhost',
            'port' => 5672,
            'username' => 'guest',
            'password' => 'guest',
            'vhost'    => '/'
        )
    ),
));
```

###  Connections retrieving
```php
$connections = $app['amqp'];
$defaultConnection = $connections['default']; 
```

###  Creating amqp connection via factory
```php
$amqpFactory = $app['amqp.factory'];
$customConnection = $amqpFactory('localhost', 5672, 'guest', 'guest', '/');
```
