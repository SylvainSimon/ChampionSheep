<?php

use Sylvanus\Routing\Routing;

class RoutingHelper extends Routing {

    public static function generateUrl($routeName) {
        return self::$urlGenerator->generate($routeName);
    }

}
