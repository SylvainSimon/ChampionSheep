<?php

namespace Sylvanus\Mail;

use \Sylvanus\Mail\MailMailer;
use \Sylvanus\Mail\MailMessage;
use \Sylvanus\Mail\MailTransport;

class Mail {

    /** @var \Swift_Mailer */
    public static $objMailer = null;

    /** @var \Swift_Transport */
    public static $objTransport = null;

    /** @var \Swift_Message */
    public static $objMessage = null;

    public static function createTransport($arrParameters) {
        switch ($arrParameters["type"]) {
            case "":
                self::$objTransport = MailTransport::create();
                break;
            case "SMTP":
                self::$objTransport = MailTransport::createSMTP($arrParameters["host"], $arrParameters["port"], $arrParameters["encryption"], $arrParameters["login"], $arrParameters["password"]);
                break;
        }

        return self::$objTransport;
    }

    public static function createMailer() {
        self::$objMailer = MailMailer::create(self::$objTransport);
    }

    public static function createMessage($arrParameters) {

        MailMessage::create();
        MailMessage::$objMessage->setSender($arrParameters["sender"]);
        MailMessage::$objMessage->setTo($arrParameters["recipients"]);
        MailMessage::$objMessage->setSubject($arrParameters["subject"]);
        MailMessage::$objMessage->setBody($arrParameters["body"], "text/html");
        
        if(isset($arrParameters["attachments"])){
            if(count($arrParameters["attachments"]) > 0){
                foreach ($arrParameters["attachments"] AS $attachement){
                    if(isset($attachement["data"])){
                        MailMessage::attachFromData($attachement);
                    }
                    if(isset($attachement["url"])){
                        MailMessage::attachFromPaths([$attachement]);
                    }
                }
            }
        }

        self::$objMessage = MailMessage::$objMessage;

        return self::$objMessage;
    }

    public static function send($objMessage) {
        return MailMailer::send($objMessage);
    }

}
