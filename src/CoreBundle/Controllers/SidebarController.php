<?php

namespace CoreBundle\Controllers;

use Knp\Menu\MenuFactory;
use Knp\Menu\Renderer\TwigRenderer;
use Knp\Menu\Matcher\Matcher;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Knp\Menu\Util\MenuManipulator;

class SidebarController {

    public function menuAction() {
        $menuRenderer = new TwigRenderer(\TwigHelper::$environnement, "@CoreBundle/left_sidebar_menu.html.twig", new Matcher());
        echo $menuRenderer->render(self::generate());
    }

    public function breadcrumpAction() {
        
        //TODO
        $menu = self::generate();
        $menuManipulator = new MenuManipulator();
        $stringBread = $menuManipulator->getPathAsString($menu->isCurrent($name));
        
        echo $stringBread;
    }

    public function generate() {

        $urlGenerator = new UrlGenerator(\RoutingHelper::getRouteCollection(), \RoutingHelper::$requestContext);
        $factory = new MenuFactory();
        $factory->addExtension(new \Knp\Menu\Integration\Symfony\RoutingExtension($urlGenerator));

        $menu = $factory->createItem("Accueil");
        $menu->addChild('Tournois', ["route" => "tournaments_list"])->setAttribute('icon', 'fa fa-calendar');
        $menu->addChild('Équipes', ["route" => "teams_list"])->setAttribute('icon', 'fa fa-users');

        return $menu;
    }

}
