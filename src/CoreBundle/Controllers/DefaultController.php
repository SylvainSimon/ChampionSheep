<?php

class DefaultController{
    
    public function indexAction(){
        
        
        $template = TwigHelper::render("base.html.twig");
        
        echo $template;
    }
}