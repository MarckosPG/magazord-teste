<?php

require_once 'vendor/autoload.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use config\Config;
use core\Router;

$isDevMode = true;
$configAnnotation = Setup::createAnnotationMetadataConfiguration([__DIR__."/src"], $isDevMode, null, null, false);

$config = new Config();

$conn = [
    'driver' => $config->DATABASE_DRIVER,
    'host' => $config->DATABASE_HOST,
    'dbname' => $config->DATABASE_NAME,
    'user' => $config->DATABASE_USER,
    'password' => $config->DATABASE_PASSWORD,
];

$entityManager = EntityManager::create($conn, $configAnnotation);

function GetEntityManager() {
    global $entityManager; 
    return $entityManager;
}

$router = new Router;
