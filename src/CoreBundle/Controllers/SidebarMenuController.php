<?php

namespace CoreBundle\Controllers;

class SidebarMenuController{
    
    public function generateAction(){
        
        $template = \TwigHelper::render("sidebar_menu.html.twig");
        echo $template;
    }
}