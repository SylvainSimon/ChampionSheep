<?php

namespace CoreBundle\Emails;

use Base\Email;

class AccountActivation extends Email {

    public $strEmail = "";

    public function generate($objAccount) {

        $id = \EncryptHelper::encrypt($objAccount->getId(), true, \ConfigHelper::get("parameters.encryption.salt"));
        $urlAccountActivation = \RoutingHelper::generateUrl("register_activate", ["id" => $id]);

        $strTemplate = \TwigHelper::render("@CoreBundle/emails/account_activation.html.twig", [
                    "urlActivation" => \RequestHelper::getSchemeAndHttpHost() . $urlAccountActivation
        ]);

        $this->strEmail = $strTemplate;
    }

}
