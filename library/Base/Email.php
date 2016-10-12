<?php

namespace Base;

use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;
use Sylvanus\Mail\MailMessage;

class Email {

    public $strEmail = "";

    public function __construct() {
        \MailHelper::createTransport(\ConfigHelper::get("email.transport"));
        \MailHelper::createMailer();
    }

    public function prepareBody($strEmail) {
        $cssInlineStyle = new CssToInlineStyles();
        return $cssInlineStyle->convert($strEmail, file_get_contents(ROOT . "/web/public/css/email.css"));
    }

    public function send($arrParametersPassed) {

        $arrParameters = [
            "sender" => \ConfigHelper::get("email.sender"),
            "recipients" => $arrParametersPassed["recipients"],
            "subject" => $arrParametersPassed["subject"],
            "body" => $this->prepareBody($this->strEmail)
        ];

        $objMessage = \MailHelper::createMessage($arrParameters);
        \MailHelper::send($objMessage);
    }

}
