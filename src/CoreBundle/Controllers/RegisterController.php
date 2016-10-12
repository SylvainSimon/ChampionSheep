<?php

namespace CoreBundle\Controllers;

use Base\Controller;
use CoreBundle\Forms\RegisterType;
use CoreBundle\Emails\AccountActivation;

class RegisterController extends Controller {

    protected $connectedController = false;

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

            $emailAccountActivation = new AccountActivation();
            $emailAccountActivation->generate($objAccount);
            $emailAccountActivation->send([
                "subject" => "Inscription sur " . \ConfigHelper::get("website.title"),
                "recipients" => [$data["email"] => $data["nickname"]]
            ]);

            \AlertHelper::addSuccess("Votre inscription a été un succès. Vous allez recevoir un e-mail afin de confirmer qu'elle vous appartient.<br/>Merci de cliquer sur le lien à l'intérieur afin de finaliser votre inscription.");
            
            \ResponseHelper::redirectByRoute("home");
        }

        echo \TwigHelper::render("@CoreBundle/pages/register.html.twig", ['form' => $form->createView()]);
    }

    public function confirmAction($id) {



        echo \TwigHelper::render("@CoreBundle/pages/register_validate.html.twig");
    }

}
