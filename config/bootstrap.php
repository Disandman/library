<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require dirname(__DIR__) . '/vendor/autoload.php';
$db = require __DIR__ . '/db.php';

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__. '/../');
$dotenv->load();

$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration([ dirname(__DIR__) . '/models'], $isDevMode, null, null, false);
$config->addEntityNamespace('', 'App\models');

// database configuration parameters

$entityManager = EntityManager::create($db, $config);