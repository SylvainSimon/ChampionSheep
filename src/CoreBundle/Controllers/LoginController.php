<?php

namespace CoreBundle\Controllers;

class LoginController {

    public static function formAction() {

        $urlPostLogin = \RoutingHelper::generateUrl("login_post");
        
        echo \TwigHelper::render("form_login.html.twig", [
            "urlPostLogin" => $urlPostLogin
        ]);
    }

    public static function loginAction() {
        
        if (\RequestHelper::getPost("FORM_SUBMIT") !== null) {
            
            $postLogin = \RequestHelper::getPost("login", "");
            $postPassword = \RequestHelper::getPost("password", "");
            
            
            
        }
    }

    public static function logoutAction() {
        
    }

}
