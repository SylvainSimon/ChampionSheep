<?php

namespace CoreBundle\TwigExtension;

class ConfigFunctionExtension extends \Twig_Extension {

    public function getFunctions() {
        return [
            'config' => new \Twig_SimpleFunction('config', [$this, 'getConfig']),
        ];
    }

    public function getConfig($attr) {
        return \ConfigHelper::get($attr);
    }

}
