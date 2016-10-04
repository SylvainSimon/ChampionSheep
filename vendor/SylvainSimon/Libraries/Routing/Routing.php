<?php

namespace Sylvanus\Routing;

use \Symfony\Component\Routing\RequestContext;
use \Symfony\Component\Routing\Loader\YamlFileLoader;
use \Symfony\Component\Config\FileLocator;
use \Symfony\Component\Routing\Router;
use \Symfony\Component\HttpKernel\Controller\ControllerResolver;

use Sylvanus\FileSystem\FileSystem;
use Sylvanus\Request\Request;

class Routing {

    public static $ressource = [];
    public static $options = [];
    public static $router = null;

    /**
     * Add a YAML routing file to ressource array
     * @param string $path
     */
    public static function setRoutingFile($path) {
        if (file_exists($path)) {
            self::$ressource = $path;
        }
    }

    /**
     * Define cache folder for routes
     * @param string $path
     */
    public static function setCacheFolder($path) {
        FileSystem::createDirectory($path);
        self::$options["cache_dir"] = $path;
    }

    /**
     * Créer l'instance de routing
     */
    public static function createRouter() {

        $locator = new FileLocator([ROOT]);
        $loader = new YamlFileLoader($locator);

        $requestContext = new RequestContext();
        $requestContext->fromRequest(Request::fillInstance());

        self::$router = new Router($loader, self::$ressource, self::$options, $requestContext);
    }

    /**
     * Resolve route with request globals and return attributs
     * @return array or null
     */
    public static function matchFromGlobals() {
        $attributes = self::$router->match(Request::getPathInfo());
        return $attributes;
    }

    /**
     * Éxécute le controller grâce aux attributs d'une route
     * @param array $attributes
     */
    public static function run($attributes) {

        Request::fillInstance()->attributes->add($attributes);

        $controllerResolver = new ControllerResolver();
        $controller = $controllerResolver->getController(Request::fillInstance());
        $arguments = $controllerResolver->getArguments(Request::fillInstance(), $controller);

        call_user_func_array($controller, $arguments);
    }

}
