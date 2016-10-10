<?php

define('ROOT', dirname(__DIR__));
$autoload = require_once ROOT . '/vendor/autoload.php';

define("PATH_COMPONENTS", ROOT . "/web/public/components");
define("PATH_CACHE_TWIG", ROOT . "/app/cache/twig");

//Register custom exceptions handlers
error_reporting(E_ERROR | E_PARSE);
ExceptionHelper::registerHandlers();

SessionHelper::init();

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

$connectionParameters = [
    "dbname" => ConfigHelper::get("database.dbname"),
    "user" => ConfigHelper::get("database.user"),
    "password" => ConfigHelper::get("database.password"),
    "host" => ConfigHelper::get("database.host"),
    "port" => ConfigHelper::get("database.port"),
    "charset" => ConfigHelper::get("database.charset")
];

DoctrineHelper::createConnection($connectionParameters, ConfigHelper::get("database.driver"));
DoctrineHelper::createEntityManager();

//Initilialize routing
RoutingHelper::setCacheFolder(ROOT . "/app/cache/routing/");
RoutingHelper::setRoutingFile(ROOT . "/app/config/routing.yml");
RoutingHelper::createRouter();

//Twig
TwigHelper::createLoader();
TwigHelper::registerTemplates([ROOT . "/app/resources/views"]);
TwigHelper::registerTemplates([ROOT . "/src/CoreBundle/Resources/views"]);
TwigHelper::createEnvironnement(ROOT . "/app/cache/twig", true);
TwigHelper::addTwigExtension(new Twig_Extension_Debug());
TwigHelper::addTwigExtension(new \CoreBundle\TwigExtension\SystemFunctionExtension());
TwigHelper::addTwigExtension(new \CoreBundle\TwigExtension\ConfigFunctionExtension());
TwigHelper::addTwigExtension(new \CoreBundle\TwigExtension\AlertFunctionExtension());
TwigHelper::addGlobal("environnement", TwigHelper::$environnement);
