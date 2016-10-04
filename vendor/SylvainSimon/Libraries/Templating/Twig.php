<?php

namespace Sylvanus\Twig;

class Twig {

    public static $loader = null;
    public static $environnement = null;

    public static function createLoader() {
        self::$loader = new \Twig_Loader_Chain();
    }

    /**
     * Add an array of template folder paths to the loader
     * @param array $arrPath
     */
    public static function registerTemplates(array $arrPath) {
        self::$loader->addLoader(new \Twig_Loader_Filesystem($arrPath));
    }

    public static function createEnvironnement($cachePath, $debug = false) {

        self::$environnement = new \Twig_Environment(self::$loader, [
            'cache' => $cachePath,
            'debug' => $debug,
            'autoescape' => false]
        );
        
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
