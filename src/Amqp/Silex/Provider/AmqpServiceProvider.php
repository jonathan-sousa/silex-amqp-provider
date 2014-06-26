<?php

namespace Amqp\Silex\Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;

class AmqpServiceProvider implements ServiceProviderInterface
{
    const AMQP = 'amqp';
    const AMQP_CONNECTIONS = 'amqp.connections';
    const AMQP_FACTORY = 'amqp.factory';

    /**
     * Registers services on the given app.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Application $app An Application instance
     */
    public function register(Application $app)
    {
        $app[self::AMQP_CONNECTIONS] = array(
            'default' => array(
                'host' => 'localhost',
                'port' => 5672,
                'username' => 'guest',
                'password' => 'guest'
            )
        );

        $app[self::AMQP_FACTORY] = $app->protect(function ($host = 'localhost', $port = 5672, $username = 'guest', $password = 'guest') use ($app) {
            return $app[AmqpServiceProvider::AMQP]->createConnection($server, $options);
        });

        $app[self::AMQP] = $app->share(function () use ($app) {
            return new AmqpConnectionProvider($app[AmqpServiceProvider::AMQP_CONNECTIONS]);
        });
    }

    /**
     * Bootstraps the application.
     *
     * This method is called after all services are registers
     * and should be used for "dynamic" configuration (whenever
     * a service must be requested).
     */
    public function boot(Application $app)
    {}
}
