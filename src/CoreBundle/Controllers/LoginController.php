<?php

namespace CoreBundle\Controllers;

class LoginController {

    public static function formAction() {
        echo \TwigHelper::render("form_login.html.twig");
    }

    public static function loginAction() {

        if (\RequestHelper::getPost("FORM_SUBMIT") !== null) {

            $postLogin = \RequestHelper::getPost("login", "");
            $postPassword = \RequestHelper::getPost("password", "");
            
            \AlertHelper::addInfo("Login : " . $postLogin . " Password : " . $postPassword);
            \ResponseHelper::reload();
        }
    }

    public static function logoutAction() {
        
    }

}
