<?php

namespace utils;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

class Conexao
{
    private static $entityManager;

    public static function getEntityManager()
    {
        if (self::$entityManager === null) {
            $config = ORMSetup::createAttributeMetadataConfiguration(
                paths: [realpath(__DIR__ . '/../model')],
                isDevMode: false,
            );

            $connection = DriverManager::getConnection([
                'driver'   => trim($_ENV['DB_DRIVER']),
                'host'     => trim($_ENV['DB_HOST']),
                'port'     => trim($_ENV['DB_PORT']),
                'dbname'   => trim($_ENV['DB_NAME']),
                'user'     => trim($_ENV['DB_USER']),
                'password' => trim($_ENV['DB_PASSWORD']),
                'sslmode'  => 'require',
            ], $config);

            $platform = $connection->getDatabasePlatform();
            $tiposPostgres = $connection->fetchFirstColumn("SELECT typname FROM pg_type");
            
            foreach ($tiposPostgres as $tipo) {
                try {
                    $platform->getDoctrineTypeMapping($tipo);
                } catch (\Exception $e) {
                    $platform->registerDoctrineTypeMapping($tipo, 'string');
                }
            }

            self::$entityManager = new EntityManager($connection, $config);
        }

        return self::$entityManager;
    }
}