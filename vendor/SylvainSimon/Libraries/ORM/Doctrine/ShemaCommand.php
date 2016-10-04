<?php

namespace Sylvanus\ORM\Doctrine;

use \Symfony\Component\Console\Application;
use \Symfony\Component\Console\Output\BufferedOutput;
use \Symfony\Component\Console\Input\ArrayInput;
use \Doctrine\ORM\Tools\Console\ConsoleRunner;
use \Sylvanus\ORM\Doctrine\Doctrine;

class ShemaCommand {

    /** @var Application */
    public static $application = null;

    /**
     * Initialise l'application pour lancer les commandes doctrine
     */
    private static function init() {

        $application = new Application();

        $em = Doctrine::getEntityManager();
        $helperSet = new \Symfony\Component\Console\Helper\HelperSet([
            'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em->getConnection()),
            'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em)]
        );

        $application->setHelperSet($helperSet);
        $application->setAutoExit(false);

        ConsoleRunner::addCommands($application);
        self::$application = $application;
    }

    /**
     * Génère les classes d'entités depuis le mapping
     * @return string
     */
    public static function generateEntities($libraryDir) {

        self::init();

        $input = new ArrayInput([
            'command' => 'orm:generate-entities',
            "dest-path" => $libraryDir,
            "--generate-annotations" => true,
            "--regenerate-entities" => true,
            "--update-entities" => false,
            "--no-backup" => true
        ]);

        $output = new BufferedOutput();
        self::$application->run($input, $output);

        return $output->fetch();
    }

    /**
     * Génère les classes de proxies des entités
     * @return string
     */
    public static function generateProxies() {

        self::init();

        $input = new ArrayInput([
            'command' => 'orm:generate-proxies'
        ]);

        $output = new BufferedOutput();
        self::$application->run($input, $output);

        return $output->fetch();
    }

    /**
     * Met à jour la base de données depuis le mapping
     * @return string
     */
    public static function updatefromShema() {

        self::init();

        $input = new ArrayInput([
            'command' => 'orm:schema-tool:update',
            "--dump-sql" => true,
            "--force" => true
        ]);

        $output = new BufferedOutput();
        self::$application->run($input, $output);

        return $output->fetch();
    }

    /**
     * Supprime le cache lié à doctrine
     * @param string $type Type de cache à supprimer
     * @return string
     */
    public static function clearCache($type) {

        self::init();

        switch ($type) {
            case "query":
                $input = new ArrayInput([
                    'command' => 'orm:clear-cache:query',
                    "--flush" => true
                ]);
                break;
            case "metadata":
                $input = new ArrayInput([
                    'command' => 'orm:clear-cache:metadata',
                    "--flush" => true
                ]);
                break;
            case "result":
                $input = new ArrayInput([
                    'command' => 'orm:clear-cache:result',
                    "--flush" => true
                ]);
                break;
            default:
                return "";
        }

        $output = new BufferedOutput();
        self::$application->run($input, $output);

        return $output->fetch();
    }

}
