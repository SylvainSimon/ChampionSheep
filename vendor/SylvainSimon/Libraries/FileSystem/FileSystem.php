<?php

namespace Sylvanus\FileSystem;

use Symfony\Component\Filesystem\Filesystem  as ComponentFilesystem;
use Symfony\Component\Filesystem\Exception\IOException;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;

class FileSystem {

    /** @var Filesystem */
    public static $fileSystem = null;

    protected static function createFilesystem() {
        self::$fileSystem = new ComponentFilesystem();
        return self::$fileSystem;
    }

    public static function fill() {
        if (self::$fileSystem === null) {
            self::createFilesystem();
        }
        return self::$fileSystem;
    }

    /**
     * Créer un ou plusieurs répertoires
     * @param mixed $path Chemin ou tableau de chemin
     * @param integer $mode
     */
    public static function createDirectory($path, $mode = 0777) {
        
        self::fill();
        
        try {
            self::$fileSystem->mkdir($path, $mode);
        } catch (IOException $e) {
            return false;
        }
    }

    /**
     * Renomme un fichier ou un dossier
     * @param string $sourcePath
     * @param string $destinationPath
     * @param bool $overwrite
     * @return boolean
     */
    public static function rename($sourcePath, $destinationPath, $overwrite = false) {
        
        self::fill();

        try {
            return self::$fileSystem->rename($sourcePath, $destinationPath, $overwrite);
        } catch (IOException $e) {
            return false;
        }
    }

    /**
     * Permet de savoir si un ou plusieurs élément existent
     * @param mixed $path Chemin ou tableau de chemin
     * @return bool Vrai si tout les éléments existent, false si un des éléments n'existe pas
     */
    public static function exists($path) {
        self::fill();
        return self::$fileSystem->exists($path);
    }

    /**
     * Permet de savoir si un chemin est absolu
     * @param string $path
     * @return bool
     */
    public static function isAbsolutePath($path) {
        self::fill();
        return self::$fileSystem->isAbsolutePath($path);
    }

    /**
     * Copie un fichier d'un endroit à un autre
     * @param string $sourcePath
     * @param string $destinationPath
     * @param bool $overwriteNewerFiles
     * @return boolean
     */
    public static function copyFile($sourcePath, $destinationPath, $overwriteNewerFiles = true) {
        self::fill();
        try {
            self::$fileSystem->copy($sourcePath, $destinationPath, $overwriteNewerFiles);
            return true;
        } catch (FileNotFoundException $e) {
            return false;
        } catch (IOException $e) {
            return false;
        }
    }

    /**
     * Copie un répertoire d'un endroit à un autre
     * @param string $sourcePath
     * @param string $destinationPath
     * @return boolean
     */
    public static function copyDirectory($sourcePath, $destinationPath) {
        self::fill();
        try {
            self::$fileSystem->mirror($sourcePath, $destinationPath);
            return true;
        } catch (IOException $e) {
            return false;
        }
    }
    
    /**
     * Déplace un fichier d'un endroit à un autre
     * @param string $sourcePath
     * @param string $destinationPath
     * @param bool $overwriteNewerFiles
     * @return boolean
     */
    public static function moveFile($sourcePath, $destinationPath, $overwriteNewerFiles = true) {
        
        self::fill();

        try {
            self::copyFile($sourcePath, $destinationPath, $overwriteNewerFiles);
            self::remove($sourcePath);
            return true;
        } catch (IOException $e) {
            return false;
        }
    }
    
    /**
     * Déplace un répertoire d'un endroit à un autre
     * @param string $sourcePath
     * @param string $destinationPath
     * @return boolean
     */
    public static function moveDirectory($sourcePath, $destinationPath) {
        
        self::fill();

        try {
            self::copyDirectory($sourcePath, $destinationPath);
            self::remove($sourcePath);
            return true;
        } catch (IOException $e) {
            return false;
        }
    }

    /**
     * Supprime un ou plusieurs élements
     * @param mixed $path Chemin ou tableau de chemin
     * @return boolean
     */
    public static function remove($path) {
        self::fill();
        try {
            self::$fileSystem->remove($path);
            return true;
        } catch (IOException $e) {
            return false;
        }
    }

    /**
     * Supprime l'ensemble des éléments contenus dans un dossier
     * @param string $path
     * @return boolean
     */
    public static function removeAllInFolder($path) {
        
        self::fill();
        
        try {
            $arrFiles = FinderHelper::findAll($path)->depth(0);
            return self::remove($arrFiles);
        } catch (IOException $e) {
            return false;
        }
    }


    /**
     * Supprime les élements d'un dossier ayant une date de modification supérieur à $minutes
     * @param string $path
     * @return boolean
     */
    public static function cleanAfterMinutes($path, $minutes = 10) {
        self::fill();

        try {
            $arrSource = FinderHelper::findAll($path)->date("< now - " . strval($minutes) . " minutes");
            self::$fileSystem->remove($arrSource);
            return true;
        } catch (IOException $e) {
            return false;
        }
    }
    
    /**
     * Modifie les droits d'un ou plusieurs éléments
     * @param mixed $path Chemin ou tableau de chemin
     * @return boolean
     */
    public static function changeChmod($path, $mode = 0777) {
        
        self::fill();

        try {
            self::$fileSystem->chmod($path, $mode);
            return true;
        } catch (IOException $e) {
            return false;
        }
    }

    /**
     * Créée et alimente un fichier avec le $content
     * @param string $filePath
     * @param string $content
     * @return boolean
     */
    public static function dumpToFile($filePath, $content = "") {
        
        self::fill();

        try {
            self::$fileSystem->dumpFile($filePath, $content);
            return true;
        } catch (IOException $e) {
            return false;
        }
    }

}
