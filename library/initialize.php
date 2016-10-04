<?php

define('ROOT', dirname(__DIR__));
$autoload = require_once ROOT . '/vendor/autoload.php';

define("PATH_COMPONENTS", ROOT . "/app/resources/public/components");
define("PATH_CACHE_TWIG", ROOT . "/app/cache/twig");

//Register custom exceptions handlers
error_reporting(E_ERROR | E_PARSE);
ExceptionHelper::registerHandlers();

//Initilialize logger
LogHelper::setLogPath(ROOT . "/app/log/");

//Initialize configuration
ConfigHelper::addFromYaml(ROOT . "/app/config/config.yml");

//Initialize Doctrine
DoctrineHelper::createEventManager();
DoctrineHelper::setCacheSystem("array");
DoctrineHelper::setEntityPath(ROOT . "/library/Entity");
DoctrineHelper::setEntityCacheDir(ROOT . "/app/cache/entities");
DoctrineHelper::setProxyCacheDir(ROOT . "/app/cache/proxies");
DoctrineHelper::setXmlMappingPath(ROOT . "/library/Entity/Mapping");

//Initilialize routing
RoutingHelper::setCacheFolder(ROOT . "/app/cache/routing/");
RoutingHelper::setRoutingFile(ROOT . "/app/config/routing.yml");
RoutingHelper::createRouter();

TwigHelper::createLoader();
TwigHelper::registerTemplates([ROOT . "/app/resources/views"]);
TwigHelper::createEnvironnement(ROOT . "/app/cache/twig", false);