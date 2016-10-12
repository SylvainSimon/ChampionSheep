<?php

namespace CoreBundle\Controllers;

use Base\Controller;

class DefaultController extends Controller {

    protected $connectedController = false;

    public function indexAction() {

        $template = \TwigHelper::render("@CoreBundle/pages/home.html.twig");
        echo $template;
    }

}
