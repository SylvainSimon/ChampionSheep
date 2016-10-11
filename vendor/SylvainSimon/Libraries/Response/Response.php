<?php

namespace Sylvanus\Response;

use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sylvanus\Request\Request;

class Response {

    public static function reload() {
        $response = new RedirectResponse(Request::getBaseUrl() . Request::getServer("REQUEST_URI"));
        (ob_get_contents()) ?: ob_clean();
        $response->send();
        exit();
    }

    public static function redirectByUrl($url = "") {
        $response = new RedirectResponse(($url === "") ? Request::getBaseUrl() : $url);
        (ob_get_contents()) ?: ob_clean();
        $response->send();
        exit();
    }

    public static function redirectToReferer() {
        $refererUrl = (Request::getServer("REFERER") !== null) ? Request::getServer("REFERER") : Request::getBaseUrl();
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
