<?php

namespace CoreBundle\Controllers;

class TopBarController {

    public static function generateUserPanelAction() {
        echo \TwigHelper::render("top_user_panel.html.twig");
    }
}
