<?php

namespace CoreBundle\TwigExtension;

class AlertFunctionExtension extends \Twig_Extension {

    public function getFunctions() {
        return [
            'alert' => new \Twig_SimpleFunction('alert', [$this, 'getAlert']),
        ];
    }

    public function getAlert() {
        return \AlertHelper::generateAlertMessage();
    }

}
