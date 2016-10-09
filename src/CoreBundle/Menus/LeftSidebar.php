<?php

namespace CoreBundle\Menus;

use Knp\Menu\MenuFactory;
use Knp\Menu\Renderer\TwigRenderer;
use Knp\Menu\Matcher\Matcher;
use Symfony\Component\Routing\Generator\UrlGenerator;

class LeftSidebar {

    public static function generate() {

        $urlGenerator = new UrlGenerator(\RoutingHelper::getRouteCollection(), \RoutingHelper::$requestContext);
        $factory = new MenuFactory();
        $factory->addExtension(new \Knp\Menu\Integration\Symfony\RoutingExtension($urlGenerator));

        $menu = $factory->createItem("root");
        $menu->addChild('Accueil', ["route" => "home2"]);

        $menuRenderer = new TwigRenderer(\TwigHelper::$environnement, 'left_sidebar_menu.html.twig', new Matcher());
        return $menuRenderer->render($menu);
    }

}
