<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();
$db = require __DIR__ . '/db.php';

$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration([dirname(__DIR__) . '/models'], $isDevMode, null, null, false);
$config->addEntityNamespace('', 'App\models');

// database configuration parameters

$entityManager = EntityManager::create($db, $config);