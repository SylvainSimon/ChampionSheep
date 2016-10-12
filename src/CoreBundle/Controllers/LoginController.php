<?php

namespace CoreBundle\Controllers;

use Base\Controller;
use CoreBundle\Forms\LoginType;

class LoginController extends Controller {

    protected $connectedController = false;

    public function formAction() {

        $form = \FormHelper::$formFactory->create(LoginType::class, []);
        $form->handleRequest(\RequestHelper::$request);

        if ($form->isValid()) {

            $data = $form->getData();
            $objAccount = \LibraryHelper::getAccountRepository()->findOneBy([
                "email" => $data["email"],
                "password" => sha1($data["password"])
            ]);

            if ($objAccount !== null) {

                \SessionHelper::set("isConnected", true);
                \SessionHelper::set("isActivate", $objAccount->getActivation());
                \SessionHelper::set("idAccount", $objAccount->getId());

                \ResponseHelper::redirectByRoute("home");
            } else {
                \AlertHelper::addError("Les identifiants que vous avez renseignés sont inconnus.");
            }
        }

        echo \TwigHelper::render("@CoreBundle/pages/login.html.twig", ['form' => $form->createView()]);
    }

    public function loginAction() {

        if (\RequestHelper::getPost("FORM_SUBMIT") !== null) {

            $postLogin = \RequestHelper::getPost("login", "");
            $postPassword = \RequestHelper::getPost("password", "");

            \AlertHelper::addInfo("Login : " . $postLogin . " Password : " . $postPassword);
            \ResponseHelper::reload();
        }
    }

    public function logoutAction() {
        \SessionHelper::clear();
        \ResponseHelper::redirectByRoute("home");
    }

}
