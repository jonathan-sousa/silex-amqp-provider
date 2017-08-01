<?php

namespace Amqp\Silex\Provider;

use PhpAmqpLib\Connection\AMQPConnection;

class AmqpConnectionProvider extends \Pimple
{
    /**
     * @param array $options
     */
    public function __construct(array $options)
    {
        $provider = $this;
        foreach ($options as $key => $connection) {
            $this[$key] = $this->share(function () use ($connection, $provider) {
                return $provider->createConnection(
                    $connection['host'],
                    $connection['port'],
                    $connection['username'],
                    $connection['password'],
                    $connection['vhost']
                );
            });
        }
    }

    /**
     * @param  string $host
     * @param  integer $port
     * @param  string $username
     * @param  string $password
     * @param  string $vhost
     * @return \AMQPConnection
     */
    public function createConnection(
        $host = 'localhost',
        $port = 5672,
        $username = 'guest',
        $password = 'guest',
        $vhost = '/'
    ) {
        return new AMQPConnection($host, $port, $username, $password, $vhost);
    }
}
