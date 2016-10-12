<?php

namespace CoreBundle\Controllers;

class DefaultController {

    public function indexAction() {

        $template = \TwigHelper::render("@CoreBundle/pages/home.html.twig");
        echo $template;
    }

}
