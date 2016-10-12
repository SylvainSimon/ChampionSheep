<?php

use Sylvanus\Routing\Routing;

class RoutingHelper extends Routing {

    public static function generateUrl($routeName, $arrParameters = [], $full = false) {
        return self::$urlGenerator->generate($routeName, $arrParameters);
    }

}
