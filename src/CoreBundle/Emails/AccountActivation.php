<?php

namespace CoreBundle\Emails;

use Base\Email;

class AccountActivation extends Email {

    public $strEmail = "";

    public function generate($objAccount) {

        $urlAccountActivation = \RoutingHelper::generateUrl("register_activate", ["id" => $objAccount->getId()]);

        $strTemplate = \TwigHelper::render("@CoreBundle/emails/account_activation.html.twig", [
                    "urlActivation" => \RequestHelper::getSchemeAndHttpHost() . $urlAccountActivation
        ]);

        $this->strEmail = $strTemplate;
    }

}
