<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

require_once "vendor/autoload.php";

$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: array(__DIR__ . "/src"),
    isDevMode: true,
);

// TODO load from .env file
$connection = DriverManager::getConnection([
  'port' => 5432,
  'host' => 'db',
  'user' => 'admin',
  'driver' => 'pgsql',
  'dbname' => 'easy-onboarding',
  'password' => 'easyonboarding123',
], $config);

$entityManager = new EntityManager($connection, $config);
