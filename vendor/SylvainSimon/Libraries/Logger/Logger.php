<?php

namespace Sylvanus\Logger;

use \Monolog\Logger AS MonologLogger;
use \Monolog\Handler\StreamHandler;
use \Monolog\Formatter\LineFormatter;
use \Sylvanus\FileSystem\FileSystem;
use \Sylvanus\Http\Request;

class Logger {

    public static $pathLog = null;
    
    public static function setLogPath($path) {
        FileSystem::createDirectory($path);
        self::$pathLog = $path;
    }
    
    public static function addError($strMessage = "", $arrayParam = []) {

        $dateFormat = "d/m/Y H:i:s";
        $output = "%datetime% > " . Request::getClientIp() . " %level_name% > %message% %context%\n";
        $formatter = new LineFormatter($output, $dateFormat, true);

        $stream = new StreamHandler(self::$pathLog . date("Y-m-d") . '/error.log', MonologLogger::DEBUG);
        $stream->setFormatter($formatter);

        $logger = new MonologLogger('errorLogger');
        $logger->pushHandler($stream);
        $logger->addError($strMessage, $arrayParam);
    }

    public static function addAccess($strMessage = "", $arrayParam = []) {

        $dateFormat = "d/m/Y H:i:s";
        $output = "%datetime% > " . Request::getClientIp() . " %message% %context%\n";
        $formatter = new LineFormatter($output, $dateFormat, true);

        $stream = new StreamHandler(self::$pathLog . date("Y-m-d") . '/access.log', MonologLogger::DEBUG);
        $stream->setFormatter($formatter);

        $logger = new MonologLogger('accessLogger');
        $logger->pushHandler($stream);
        $logger->addInfo($strMessage, $arrayParam);
    }

    public static function writeLogForException($exception) {

        $content = "EXCEPTION > ";
        $content .= $exception->getCode() . " " . $exception->getMessage();

        $content .= "\r\n";
        $content .= "\t\tTrace complète : ";
        $content .= "\r\n";
        $content .= "\t\t" . str_replace("\n", "\r\n\t\t", $exception->getTraceAsString());

        self::addError($content);
    }

    public static function writeLogForError($error) {

        $content = "";
        $content .= "Type : " . $error["type"] . " Erreur : " . $error["message"];
        $content .= "\r\n";
        $content .= "\t\tFichier : " . $error["file"];
        $content .= "\r\n";
        $content .= "\t\tLigne : " . $error["line"];

        self::addError($content);
    }

}
