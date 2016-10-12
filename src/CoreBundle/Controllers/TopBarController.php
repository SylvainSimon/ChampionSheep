<?php

namespace CoreBundle\Controllers;

class TopBarController {

    public static function userPanelAction() {

        if (IS_CONNECTED) {
            echo \TwigHelper::render("@CoreBundle/top_bar_user_panel.html.twig");
        } else {
            echo \TwigHelper::render("@CoreBundle/top_bar_links.html.twig");
        }
    }

}
