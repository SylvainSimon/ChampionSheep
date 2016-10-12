<?php

namespace CoreBundle\Controllers;

use CoreBundle\Forms\RegisterType;

class RegisterController {

    public function formAction() {

        $form = \FormHelper::$formFactory->create(RegisterType::class, []);
        $form->handleRequest(\RequestHelper::$request);
        
        if ($form->isValid()) {

            $entityManager = \DoctrineHelper::getEntityManager();
            $data = $form->getData();
            
            $objAccount = new \Entity\Account();
            $objAccount->setNickname($data["nickname"]);
            $objAccount->setEmail($data["email"]);
            $objAccount->setPassword(sha1($data["password"]));
            
            $entityManager->persist($objAccount);
            $entityManager->flush();
            
            \AlertHelper::addSuccess("Inscription réussi");
            
            \ResponseHelper::redirectByRoute("home");
        }

        echo \TwigHelper::render("@CoreBundle/pages/register.html.twig", ['form' => $form->createView()]);
    }
}
