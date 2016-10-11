<?php

namespace CoreBundle\Controllers;

class RegisterController {

    public static function formAction() {
        echo \TwigHelper::render("form_register.html.twig");
    }

    public static function registerAction() {

        if (\RequestHelper::getPost("FORM_SUBMIT") !== null) {

            $postLogin = \RequestHelper::getPost("login", "");
            $postPassword = \RequestHelper::getPost("password", "");

            \AlertHelper::addInfo("Login : " . $postLogin . " Password : " . $postPassword);
            \ResponseHelper::reload();
        }
    }

    public static function logoutAction() {
        
    }

    public static function checkInputEmail() {

        $postEmail = \RequestHelper::getPost("email", "");
        $objAccount = \LibraryHelper::getAccountRepository()->findBy(["email" => $postEmail]);

        \ResponseHelper::returnJson((count($objAccount) > 0) ? false : true);
    }

}
