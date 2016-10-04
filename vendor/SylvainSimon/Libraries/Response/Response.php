<?php

namespace Sylvanus\Response;

use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sylvanus\Request\Request;

class Response {

    public static function reload() {
        $response = new RedirectResponse(\RequestHelper::url() . \RequestHelper::getServer("requestUri"));
        (ob_get_contents()) ?: ob_clean();
        $response->send();
        exit();
    }

    public static function redirectByUrl($url = "") {
        $response = new RedirectResponse(($url === "") ? \RequestHelper::base() : $url);
        (ob_get_contents()) ?: ob_clean();
        $response->send();
        exit();
    }

    public static function redirectToReferer() {
        $refererUrl = (Request::getFromRequest("referer", RequestBag::BAG_SERVER) !== null) ? Request::getFromRequest("referer", RequestBag::BAG_SERVER) : \RequestHelper::url();
        $response = new RedirectResponse($refererUrl);
        (ob_get_contents()) ?: ob_clean();
        $response->send();
        exit();
    }

    public static function returnJson($data = ["Empty data"]) {
        $response = new JsonResponse($data);
        (ob_get_contents()) ?: ob_clean();
        $response->send();
        exit();
    }

    public static function returnException($code = 500, $content = "") {
        $response = new HttpFoundationResponse();
        $response->setStatusCode($code);
        if ($content !== "") {
            $response->setContent($content);
        }
        (ob_get_contents()) ?: ob_clean();
        $response->send();
        exit();
    }
    

    public static function exception403() {
        self::returnException(HttpFoundationResponse::HTTP_FORBIDDEN);
    }
    
    public static function exception404() {
        self::returnException(HttpFoundationResponse::HTTP_NOT_FOUND);
    }

}
