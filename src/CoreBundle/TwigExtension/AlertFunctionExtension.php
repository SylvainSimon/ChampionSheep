<?php

namespace CoreBundle\TwigExtension;

class AlertFunctionExtension extends \Twig_Extension {

    public function getFunctions() {
        return [
            'alert' => new \Twig_SimpleFunction('alert', [$this, 'getAlert']),
            'checkActivation' => new \Twig_SimpleFunction('checkActivation', [$this, 'checkActivation']),
        ];
    }

    public function getAlert() {
        return \AlertHelper::generateAlertMessage();
    }

    public function checkActivation() {
        if(IS_CONNECTED == true && IS_ACTIVATE == false){
            \AlertHelper::addWarning("Votre compte n'est pas activé. Merci de cliquer sur le lien présent dans le mail d'activation pour finaliser votre inscription sur le site.");
        }
    }

}
