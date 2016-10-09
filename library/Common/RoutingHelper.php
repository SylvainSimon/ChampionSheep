<?php

use Sylvanus\Routing\Routing;

class RoutingHelper extends Routing {

    public static function generateUrl($routeName) {
        self::$urlGenerator->generate($routeName);
    }

}
