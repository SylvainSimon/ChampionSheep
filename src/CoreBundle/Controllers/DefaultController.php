<?php

namespace CoreBundle\Controllers;

class DefaultController{
    
    public function indexAction(){
               
        $template = \TwigHelper::render("home.html.twig");
        echo $template;
    }
}