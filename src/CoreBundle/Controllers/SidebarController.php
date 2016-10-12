<?php

namespace CoreBundle\Controllers;

use Knp\Menu\MenuFactory;
use Knp\Menu\Renderer\TwigRenderer;
use Knp\Menu\Matcher\Matcher;
use Symfony\Component\Routing\Generator\UrlGenerator;

class SidebarController {

    public static function generateMenuAction() {

        $urlGenerator = new UrlGenerator(\RoutingHelper::getRouteCollection(), \RoutingHelper::$requestContext);
        $factory = new MenuFactory();
        $factory->addExtension(new \Knp\Menu\Integration\Symfony\RoutingExtension($urlGenerator));

        $menu = $factory->createItem("root");
        $menu->addChild('Accueil', ["route" => "home"]);

        $nodeAvecDesTrucs = $menu->addChild("AccueilAvecDesTruc", ["route" => "home"]);
        $nodeAvecDesTrucs->addChild('en dessous', ["route" => "home"]);

        $menu->addChild('AccueilSeulEnPlus', ["route" => "home"]);

        $menu->addChild('Accueil', ["route" => "home"]);

        $menuRenderer = new TwigRenderer(\TwigHelper::$environnement, "@CoreBundle/left_sidebar_menu.html.twig", new Matcher());
        echo $menuRenderer->render($menu);
    }

    public static function generateUserPanelAction() {
        echo \TwigHelper::render("@CoreBundle/left_user_panel.html.twig");
    }

}
