<?php

use App\config\DB_connect;
use Doctrine\ORM\Tools\Console\ConsoleRunner;


$entityManagerClass = new DB_connect();
$entityManager = $entityManagerClass->connect();

return ConsoleRunner::createHelperSet($entityManager);
