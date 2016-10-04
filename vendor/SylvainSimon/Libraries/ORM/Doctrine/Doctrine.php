<?php

namespace Sylvanus\ORM\Doctrine;

use Sylvanus\FileSystem\FileSystem;

class Doctrine {

    public static $defaultConnection = null;
    public static $eventManager = null;
    public static $entityManager = null;
    public static $xmlMappingDir = null;
    public static $entityPath = [];
    public static $proxyCacheDir = "";
    public static $entityCacheDir = "";
    public static $cacheSystem = "array";

    public static function createEventManager() {
        self::$eventManager = new \Doctrine\Common\EventManager();
    }

    public static function createConnection($parameters = [], $driver = null) {

        $config = new \Doctrine\DBAL\Configuration();

        $connectionParameters = [
            'dbname' => $parameters["dbname"],
            'user' => $parameters["user"],
            'password' => $parameters["password"],
            'host' => $parameters["host"],
            'port' => $parameters["port"],
            "charset" => $parameters["charset"],
            "driver" => $driver
        ];

        $connectionParameters['defaultTableOptions'] = [
            'collate' => 'utf8_general_ci'
        ];

        /** @var \Doctrine\Common\EventManager $eventManager */
        $eventManager = self::$eventManager;

        $connection = \Doctrine\DBAL\DriverManager::getConnection($connectionParameters, $config, $eventManager);
        $connection->getConfiguration()->setSQLLogger(null);

        // fix platform differences
        $platform = $connection->getDatabasePlatform();
        $platform->registerDoctrineTypeMapping('bit', 'boolean');

        self::$defaultConnection = $connection;

        return self::$defaultConnection;
    }

    public static function setXmlMappingPath($path) {
        FileSystem::createDirectory($path);
        self::$xmlMappingDir = $path;
    }

    public static function setEntityPath($path) {
        FileSystem::createDirectory($path);
        self::$entityPath[] = $path;
    }

    public static function setProxyCacheDir($path) {
        FileSystem::createDirectory($path);
        self::$proxyCacheDir = $path;
    }

    public static function setEntityCacheDir($path) {
        FileSystem::createDirectory($path);
        self::$entityCacheDir = $path;
    }

    public static function setCacheSystem($system) {
        self::$cacheSystem = $system;
    }

    public static function createEntityManager($connection = null, $eventManager = null) {

        $config = new \Doctrine\ORM\Configuration();
        $config->setProxyDir(self::$proxyCacheDir);
        $config->setProxyNamespace('entities\proxies');

        $cache = false;
        switch (self::$cacheSystem) {
            case 'apc':
                $cache = new \Doctrine\Common\Cache\ApcCache();
                break;
            case 'array':
                $cache = new \Doctrine\Common\Cache\ArrayCache();
                break;
        }

        if (self::$cacheSystem !== false) {
            $reader = new \Doctrine\Common\Annotations\FileCacheReader(new \Doctrine\Common\Annotations\AnnotationReader(), self::$entityCacheDir, false);
        } else {
            $reader = new \Doctrine\Common\Annotations\CachedReader(new \Doctrine\Common\Annotations\AnnotationReader(), $cache, false);
        }

        $driverImpl = new \Doctrine\ORM\Mapping\Driver\AnnotationDriver($reader, self::$entityPath);

        if (self::$xmlMappingDir !== null) {
            $driverImpl = new \Doctrine\ORM\Mapping\Driver\XmlDriver(self::$xmlMappingDir);
        }

        // registering noop annotation autoloader - allow all annotations by default
        \Doctrine\Common\Annotations\AnnotationRegistry::registerLoader('class_exists');
        $config->setMetadataDriverImpl($driverImpl);

        // Caching Configuration
        $cache = new \Doctrine\Common\Cache\ArrayCache();
        $config->setMetadataCacheImpl($cache);
        $config->setQueryCacheImpl($cache);

        $entityManager = \Doctrine\ORM\EntityManager::create(self::$defaultConnection, $config, self::$eventManager);

        self::$entityManager = $entityManager;

        return $entityManager;
    }

    /**
     * Return EntityManager object
     * @return \Doctrine\ORM\EntityManager
     */
    public static function getEntityManager() {
        return self::$entityManager;
    }

    /**
     * Return connection DBAL object
     * @return \Doctrine\DBAL\Connection
     */
    public static function getConnection() {
        return self::$defaultConnection;
    }
    
    public static function getRepository($className) {
        $entityManager = self::getEntityManager();
        return $entityManager->getRepository($className);
    }

}
