<?php

require_once __DIR__ . '/../library/initialize.php';

$doctrineParameters = [
    "dbname" => ConfigHelper::get("doctrine.database_name"),
    "user" => ConfigHelper::get("doctrine.database_user"),
    "password" => ConfigHelper::get("doctrine.database_password"),
    "host" => ConfigHelper::get("doctrine.database_host"),
    "port" => ConfigHelper::get("doctrine.database_port"),
    "charset" => ConfigHelper::get("doctrine.database_charset")
];
                    
DoctrineHelper::createConnection($doctrineParameters, ConfigHelper::get("doctrine.database_driver"));
DoctrineHelper::createEntityManager();

$matchedRoute = RoutingHelper::matchFromGlobals();
RoutingHelper::run($matchedRoute);