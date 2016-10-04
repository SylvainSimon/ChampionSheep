<?php

namespace Sylvanus\Http\Request;

use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;

class Request {

    const BAG_GET = 1;
    const BAG_POST = 2;
    const BAG_HEADER = 3;
    const BAG_SERVER = 4;
    const BAG_COOKIE = 5;
    const BAG_FILE = 6;
    
    /** @var HttpFoundationRequest */
    public static $request = null;

    /**
     * Instancie la HttpFoundationRequest
     * @return HttpFoundationRequest
     */
    public static function createFromGlobals() {
        if (self::$request === null) {
            self::$request = HttpFoundationself::createFromGlobals();
        }
        return self::$request;
    }

    /**
     * Alimente l'instance de HttpFoundationRequest
     * @return HttpFoundationRequest
     */
    public static function fillInstance() {
        if (self::$request === null) {
            self::createFromGlobals();
        }

        return self::$request;
    }

    /**
     * Retourne la valeur d'une clè associée au bag
     * @param string $key
     * @param string $bag
     * @param mixed $default
     * @return type
     */
    public static function getFromRequest($key, $bag = self::BAG_POST, $default = null) {

        self::fillInstance();
        $value = $default;

        switch ($bag) {
            case self::BAG_GET:
                $value = self::$request->query->get($key);
                break;
            case self::BAG_POST:
                $value = self::$request->request->get($key);
                break;
            case self::BAG_COOKIE:
                $value = self::$request->cookies->get($key);
                break;
            case self::BAG_FILE:
                $value = self::$request->files->get($key);
                break;
            case self::BAG_HEADER:
                $value = self::$request->headers->get($key);
                break;
            case self::BAG_SERVER:
                $value = self::$request->server->get($key);
                break;
        }
        
        return ($value === null) ? $default : $value;
    }
    
    public static function getQuery($key, $default = null) {
        return self::getFromRequest($key, self::BAG_GET, $default);
    }

    public static function getHeaders($key, $default = null) {
        return self::getFromRequest($key, self::BAG_HEADER, $default);
    }

    public static function getPost($key, $default = null) {
        return self::getFromRequest($key, self::BAG_POST, $default);
    }

    public static function getCookie($key, $default = null) {
        return self::getFromRequest($key, self::BAG_COOKIE, $default);
    }

    public static function getServer($key, $default = null) {
        return self::getFromRequest($key, self::BAG_SERVER, $default);
    }

    public static function getFile($key, $default = null) {
        return self::getFromRequest($key, self::BAG_FILE, $default);
    }

    public static function getContent() {
        return self::$request->getContent();
    }

    /**
     * Retourne un tableau de valeur associées au bag
     * @param string $bag
     * @return type
     */
    public static function getAllFromRequest($bag = self::BAG_POST) {
        self::fillInstance();

        switch ($bag) {
            case self::BAG_GET:
                return self::$request->query->all();
            case self::BAG_POST:
                return self::$request->request->all();
            case self::BAG_COOKIE:
                return self::$request->cookies->all();
            case self::BAG_FILE:
                return self::$request->files->all();
            case self::BAG_HEADER:
                return self::$request->headers->all();
            case self::BAG_SERVER:
                return self::$request->server->all();
        }
    }
    
    public static function getAllQuery() {
        return self::getAllFromRequest(self::BAG_GET);
    }

    public static function getAllHeaders() {
        return self::getAllFromRequest(self::BAG_HEADER);
    }

    public static function getAllPost() {
        return self::getAllFromRequest(self::BAG_POST);
    }

    public static function getAllCookie() {
        return self::getAllFromRequest(self::BAG_COOKIE);
    }

    public static function getAllFile() {
        return self::getAllFromRequest(self::BAG_FILE);
    }

    public static function getAllServer() {
        return self::getAllFromRequest(self::BAG_SERVER);
    }

    /**
     * Obtient la méthode d'appel de la requête
     * @return type
     */
    public static function getMethod() {
        self::fillInstance();
        return self::$request->getMethod();
    }

    /**
     * Indique si l'appel a été fait par requète ajax
     * @return bool
     */
    public static function isXmlHttpRequest() {
        self::fillInstance();
        return self::$request->isXmlHttpRequest();
    }

    /**
     * Obtient le chemin après le host de l'URL
     * @return string
     */
    public static function getPathInfo() {
        self::fillInstance();
        return self::$request->getPathInfo();
    }

    /**
     * Indique si l'url d'appel est sécurisé par SSL
     * @return bool
     */
    public static function isSecure() {
        self::fillInstance();
        return self::$request->isSecure();
    }

    /**
     * Retourne le domaine de l'URL
     * @return string
     */
    public static function getHost() {
        self::fillInstance();
        return self::$request->getHost();
    }

    /**
     * Retourne le protocole et le domaine de l'URL
     * @return string
     */
    public static function getSchemeAndHttpHost() {
        self::fillInstance();
        return self::$request->getSchemeAndHttpHost();
    }

    /**
     * Obtient l'IP du client appellant
     * @return string
     */
    public static function getClientIp() {
        self::fillInstance();
        return self::$request->getClientIp();
    }

}
