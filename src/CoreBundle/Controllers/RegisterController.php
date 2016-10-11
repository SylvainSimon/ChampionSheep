<?php

namespace CoreBundle\Controllers;

use CoreBundle\Forms\RegisterType;

class RegisterController {

    public static function formAction() {

        $defaults = [];
        $form = \FormHelper::$formFactory->create(RegisterType::class, [], $defaults);
        $form->handleRequest(\RequestHelper::$request);
        
        $errors = $form->getErrors();

        if ($form->isValid()) {

            \ResponseHelper::redirectByRoute("home");
        }


        echo \TwigHelper::render("form_register.html.twig", ['form' => $form->createView()]);
    }

    public static function checkInputEmail() {

        $postEmail = \RequestHelper::getPost("email", "");
        $objAccount = \LibraryHelper::getAccountRepository()->findBy(["email" => $postEmail]);

        \ResponseHelper::returnJson((count($objAccount) > 0) ? false : true);
    }

}
