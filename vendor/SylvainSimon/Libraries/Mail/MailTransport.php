<?php

namespace Sylvanus\Mail;

class MailTransport {

    public static $objTransport = null;
    
    public static function getTransport() {
        return self::$objTransport;
    }

    public static function create() {
        self::$objTransport = \Swift_MailTransport::newInstance();
        return self::$objTransport;
    }

    public static function createSMTP($host = "localhost", $port = "25", $encryption = "ssl", $user = "", $password = "") {

        self::$objTransport = \Swift_SmtpTransport::newInstance($host, $port);
        self::$objTransport->setEncryption($encryption);

        if ($user !== "") {
            self::$objTransport->setUsername($user);
            self::$objTransport->setPassword($password);
        }
        
        return self::$objTransport;
    }

}
