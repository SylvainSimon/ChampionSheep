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
        $menu->addChild('Accueil', ["route" => "home"]);
        
        $nodeAvecDesTrucs = $menu->addChild("AccueilAvecDesTruc", ["route" => "home"]);
        $nodeAvecDesTrucs->addChild('Historique des rendez-vous', ["route" => "home"]);
        
        $menu->addChild('AccueilSeulEnPlus', ["route" => "home"]);

        
        $menu->addChild('Accueil', ["route" => "home"]);

        $menuRenderer = new TwigRenderer(\TwigHelper::$environnement, 'left_sidebar_menu.html.twig', new Matcher());
        return $menuRenderer->render($menu);
    }

}
