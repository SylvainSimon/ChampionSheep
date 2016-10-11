<?php

namespace CoreBundle\Controllers;

use CoreBundle\Forms\RegisterType;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface();
class RegisterController {

    public static function formAction() {

        $defaults = [];
        $form = \FormHelper::$formFactory->create(RegisterType::class, [], $defaults);
        $form->handleRequest(\RequestHelper::$request);
        
        if ($form->isValid()) {

            $entityManager = \DoctrineHelper::getEntityManager();
            $data = $form->getData();
            
            $objAccount = new \Entity\Account();
            $objAccount->setNickname($data["nickname"]);
            $objAccount->setEmail($data["nickname"]);
            $objAccount->setPassword($data["password"]);
            
            $entityManager->persist($objAccount);
            $entityManager->flush();
            
            \AlertHelper::addSuccess("Inscription réussi");
            
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
