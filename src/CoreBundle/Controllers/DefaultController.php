<?php

namespace CoreBundle\Controllers;

use CoreBundle\Menus\LeftSidebar;

class DefaultController{
    
    public function indexAction(){
               
        $template = \TwigHelper::render("base.html.twig", ["menu" => LeftSidebar::generate()]);
        echo $template;
    }
}