<?php

use Sylvanus\Response\Response;

class ResponseHelper extends Response {

    public static function redirectByRoute($routeName) {
        $url = RoutingHelper::generateUrl($routeName);
        self::redirectByUrl($url);
    }

}
