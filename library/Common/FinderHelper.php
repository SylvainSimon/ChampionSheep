<?php

use Symfony\Component\Finder\Finder;
use Sylvanus\FileSystem\FileSystem;

class FinderHelper {

    /** @var Finder */
    public static $finder = null;

    protected static function createFinder() {
        self::$finder = new Finder();
        return self::$finder;
    }

    public static function fillFinder() {
        self::createFinder();
    }

    /**
     * @param string $path
     * @return Finder
     */
    public static function findAll($path, $createIfNotExist = true) {
        self::fillFinder();

        if ($createIfNotExist) {
            FileSystem::createDirectory($path);
        }

        return self::$finder->in($path);
    }

    /**
     * @param string $path
     * @return Finder
     */
    public static function findAllFiles($path, $createIfNotExist = true) {
        self::fillFinder();

        if ($createIfNotExist) {
            FileSystem::createDirectory($path);
        }

        return self::$finder->files()->in($path);
    }

    /**
     * @param string $path
     * @return Finder
     */
    public static function findAllFolders($path, $createIfNotExist = true) {
        self::fillFinder();

        if ($createIfNotExist) {
            FileSystem::createDirectory($path);
        }

        return self::$finder->directories()->in($path);
    }

}
