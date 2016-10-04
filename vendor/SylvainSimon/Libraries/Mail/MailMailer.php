<?php

namespace Sylvanus\Mail;

class MailMailer {

    /** @var \Swift_Mailer */
    public static $objMailer = null;

    public static function create(\Swift_Transport $objTransport) {
        self::$objMailer = \Swift_Mailer::newInstance($objTransport);
        return self::$objMailer;
    }

    /**
     * Send e-mail
     * @param \Swift_Message $objMessage
     * @param array $failedRecipients
     * @return array Array of e-mail failed
     */
    public static function send($objMessage, $failedRecipients = []) {
        self::$objMailer->send($objMessage, $failedRecipients);
        return $failedRecipients;
    }

}
