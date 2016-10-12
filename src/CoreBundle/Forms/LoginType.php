<?php

namespace CoreBundle\Forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints;

class LoginType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add('email', EmailType::class, [
            'label' => "Adresse e-mail",
            'attr' => [
                "placeholder" => "example@gmail.com",
                "iconLeft" => "material-icons md-icon-local-post-office md-dark"
            ],
            'constraints' => [
                new Constraints\NotBlank(),
                new Constraints\Email
            ]
        ]);
        
        $builder->add('password', PasswordType::class, [
            'label' => "Mot de passe",
            'attr' => [
                "iconLeft" => "material-icons md-icon-lock md-dark"
            ],
            'constraints' => [
                new Constraints\NotBlank()
            ]
        ]);
        
        $builder->setAction(\RoutingHelper::generateUrl("login_form"));
        $builder->getForm();
    }

}
