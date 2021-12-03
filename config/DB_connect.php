<?php

namespace App\config;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class DB_connect
{

    public function connect()
    {

        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();
        $db = require __DIR__ . '/db.php';

        $isDevMode = true;
        $config = Setup::createAnnotationMetadataConfiguration([dirname(__DIR__) . '/models'], $isDevMode, null, null, false);
        $config->addEntityNamespace('', 'App\models');

// database configuration parameters

        $entityManager = EntityManager::create($db, $config);

        return $entityManager;
    }

}
$containerBuilder = new ContainerBuilder();
$containerBuilder->register('db.con', 'DB_connect');