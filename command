<?php

require_once 'library/initialize.php';

$em = DoctrineHelper::getEntityManager();

$helperSet = new \Symfony\Component\Console\Helper\HelperSet([
    'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em->getConnection()),
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em),
    'dialog' => new Symfony\Component\Console\Helper\QuestionHelper(),
        ]
);

$cli = new Symfony\Component\Console\Application('Doctrine Command Line Interface', \Doctrine\ORM\Version::VERSION);
$cli->setCatchExceptions(true);
$cli->setHelperSet($helperSet);

\Doctrine\ORM\Tools\Console\ConsoleRunner::addCommands($cli);

$cli->addCommands(array(
    new \Doctrine\DBAL\Migrations\Tools\Console\Command\DiffCommand(),
    new \Doctrine\DBAL\Migrations\Tools\Console\Command\ExecuteCommand(),
    new \Doctrine\DBAL\Migrations\Tools\Console\Command\GenerateCommand(),
    new \Doctrine\DBAL\Migrations\Tools\Console\Command\MigrateCommand(),
    new \Doctrine\DBAL\Migrations\Tools\Console\Command\StatusCommand(),
    new \Doctrine\DBAL\Migrations\Tools\Console\Command\VersionCommand()
));

$cli->run();
