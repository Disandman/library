<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner;

// replace with file to your own project bootstrap
require "config/bootstrap.php";

/** @var array $entityManager */
return ConsoleRunner::createHelperSet($entityManager);
