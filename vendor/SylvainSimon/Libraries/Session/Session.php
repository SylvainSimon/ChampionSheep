<?php

namespace Sylvanus\Session;

use \Symfony\Component\HttpFoundation\Session\Session AS HttpFoundationSession;

class Session {

    public static $session = null;

    public static function init() {

        $session = new HttpFoundationSession();
        $session->start();

        self::$session = $session;
    }

    public static function get($attr) {
        return self::$session->get($attr);
    }

    public static function set($attr, $value) {
        return self::$session->set($attr, $value);
    }

    public static function setFlash($bag, $value) {
        self::$session->getFlashBag()->add($bag, $value);
    }

    public static function getFlash($bag) {

        $arr = [];

        foreach (self::$session->getFlashBag()->get($bag, []) as $message) {
            $arr[] = $message;
        }

        return $arr;
    }

}
