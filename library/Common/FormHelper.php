<?php

use Symfony\Component\Form\Forms;
use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationExtension;
use Symfony\Component\Form\Extension\Csrf\CsrfExtension;
use Symfony\Component\Security\Csrf\TokenStorage\SessionTokenStorage;
use Symfony\Component\Security\Csrf\TokenGenerator\UriSafeTokenGenerator;
use Symfony\Component\Security\Csrf\CsrfTokenManager;
use Symfony\Bridge\Twig\Form\TwigRendererEngine;
use Symfony\Bridge\Twig\Extension\FormExtension;
use Symfony\Bridge\Twig\Form\TwigRenderer;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Validator\Validation;
use Sylvanus\Twig\Twig;
use Symfony\Bridge\Twig\Extension\TranslationExtension;

class FormHelper {

    /** @var Symfony\Component\Form\FormFactory */
    public static $formFactory = null;

    public static function createFactory() {

        //$vendorFormDir = ROOT . "/vendor/symfony/form";
        //$vendorValidatorDir = ROOT . "/vendor/symfony/validator";
        $validator = Validation::createValidatorBuilder()->setTranslator(TranslationHelper::$translator)->getValidator();

        $csrfGenerator = new UriSafeTokenGenerator();
        $csrfStorage = new SessionTokenStorage(SessionHelper::$session);
        $csrfManager = new CsrfTokenManager($csrfGenerator, $csrfStorage);

        $formFactory = Forms::createFormFactoryBuilder();
        $formFactory->addExtension(new HttpFoundationExtension());
        $formFactory->addExtension(new CsrfExtension($csrfManager));
        $formFactory->addExtension(new ValidatorExtension($validator));

        TwigHelper::addTwigExtension(new TranslationExtension(TranslationHelper::$translator));
        
        //Rajout dans twig
        $defaultFormTheme = 'bootstrap_3_layout.html.twig';
        $formEngine = new TwigRendererEngine([$defaultFormTheme]);
        $formEngine->setEnvironment(Twig::$environnement);
        
        TwigHelper::addTwigExtension(new FormExtension(new TwigRenderer($formEngine, $csrfManager)));

        self::$formFactory = $formFactory->getFormFactory();
    }

}
