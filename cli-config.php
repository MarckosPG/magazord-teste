<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;

require_once __DIR__ .'/index.php';

$entityManager = GetEntityManager(); 

return ConsoleRunner::createHelperSet($entityManager);