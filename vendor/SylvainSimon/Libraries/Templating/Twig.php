<?php

namespace Sylvanus\Twig;

class Twig {

    public static $loader = null;
    public static $environnement = null;

    public static function createLoader() {
        self::$loader = new \Twig_Loader_Filesystem();
    }

    public static function setPaths($arrPath) {
        self::$loader->setPaths($arrPath);
    }

    public static function addPath($src, $name = null) {
        self::$loader->addPath($src, $name);
    }

    public static function createEnvironnement($cachePath, $debug = false) {

        self::$environnement = new \Twig_Environment(self::$loader, [
            'cache' => $cachePath,
            'debug' => $debug,
            'autoescape' => false]
        );
    }

    public static function addGlobal($name, $value) {
        self::$environnement->addGlobal($name, $value);
    }

    public static function addTwigExtension($instance) {
        self::$environnement->addExtension($instance);
    }

    public static function addTwigExtensions() {
        self::$environnement->addExtension(new \Twig_Extensions_Extension_Text());
        self::$environnement->addExtension(new \Twig_Extensions_Extension_I18n());
        self::$environnement->addExtension(new \Twig_Extensions_Extension_Intl());
        self::$environnement->addExtension(new \Twig_Extensions_Extension_Array());
        self::$environnement->addExtension(new \Twig_Extensions_Extension_Date());
    }

    public static function addTwigTranslationExtension($translator) {
        self::$environnement->addExtension(new \Symfony\Bridge\Twig\Extension\TranslationExtension($translator));
    }

    public static function render($name, $arrParameters = []) {
        return self::$environnement->render($name, $arrParameters);
    }

}
