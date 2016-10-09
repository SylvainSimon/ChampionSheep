<?php

namespace CoreBundle\TwigExtension;

class ControllerFunctionExtension extends \Twig_Extension {

    public function getFunctions() {
        return [
            'controller' => new \Twig_SimpleFunction('controller', [$this, 'runController']),
            'path' => new \Twig_SimpleFunction('path', [$this, 'generatePath'])
        ];
    }

    public function runController($class, $function, $arguments) {
        call_user_func_array([new $class, $function], $arguments);
    }

    public function generatePath($routeName) {
        return \RoutingHelper::generateUrl($routeName);
    }

}
