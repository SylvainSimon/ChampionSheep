<?php

namespace CoreBundle\TwigExtension;

class ConfigFunctionExtension extends \Twig_Extension {

    public function getFunctions() {
        return [
            'session' => new \Twig_SimpleFunction('session', [$this, 'getSession'])
        ];
    }

    public function getSession($attr) {
        return \SessionHelper::get($attr);
    }

}
