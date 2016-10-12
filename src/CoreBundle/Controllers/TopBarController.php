<?php

namespace CoreBundle\Controllers;

use Base\Controller;

class TopBarController extends Controller {

    protected $connectedController = false;

    public function userPanelAction() {

        if (IS_CONNECTED) {
            echo \TwigHelper::render("@CoreBundle/top_bar_user_panel.html.twig");
        } else {
            echo \TwigHelper::render("@CoreBundle/top_bar_links.html.twig");
        }
    }

}
