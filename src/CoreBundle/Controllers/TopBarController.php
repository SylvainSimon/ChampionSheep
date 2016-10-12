<?php

namespace CoreBundle\Controllers;

class TopBarController {

    public static function userPanelAction() {
        echo \TwigHelper::render("@CoreBundle/top_user_panel.html.twig");
    }
}
