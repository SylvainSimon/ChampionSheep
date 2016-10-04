<?php

require_once __DIR__ . '/../library/initialize.php';

/*
$connectionParameters = [
    "dbname" => ConfigHelper::get("default_connection.database_name"),
    "user" => ConfigHelper::get("default_connection.database_user"),
    "password" => ConfigHelper::get("default_connection.database_password"),
    "host" => ConfigHelper::get("default_connection.database_host"),
    "port" => ConfigHelper::get("default_connection.database_port"),
    "charset" => ConfigHelper::get("default_connection.database_charset")
];

DoctrineHelper::createConnection($connectionParameters, ConfigHelper::get("default_connection.database_driver"));
DoctrineHelper::createEntityManager();
*/

$matchedRoute = RoutingHelper::matchFromGlobals();
RoutingHelper::run($matchedRoute);