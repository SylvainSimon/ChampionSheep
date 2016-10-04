<?php

error_reporting(E_ERROR | E_PARSE);
define('ROOT', dirname(__DIR__));

require_once ROOT . '/vendor/autoload.php';

ExceptionHelper::registerHandlers();

//Initialize Config
ConfigHelper::addFromYaml(ROOT . "/app/config/config.yml");

//Initialize Doctrine
DoctrineHelper::createEventManager();
DoctrineHelper::setCacheSystem("array");
DoctrineHelper::setEntityPath(ROOT . "/library/Entity");
DoctrineHelper::setEntityCacheDir(ROOT . "/app/cache/entities");
DoctrineHelper::setProxyCacheDir(ROOT . "/app/cache/proxies");
DoctrineHelper::setXmlMappingPath(ROOT . "/library/Entity/Mapping");

//Initilialize logger
LogHelper::setLogPath(ROOT . "/app/log/");

//Initilialize routing
RoutingHelper::setCacheFolder(ROOT . "/app/cache/routing/");
RoutingHelper::setRoutingFile(ROOT . "/app/routing/routing.yml");
RoutingHelper::createRouter();
