<?php

namespace CoreBundle\Forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Validator\Constraints;

class RegisterType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
                ->add('nickname', TextType::class, [
                    'label' => "Pseudonyme de joueur",
                    'attr' => [
                        "placeholder" => "Sylvanus, Taimou, etc.."
                    ],
                    'constraints' => [
                        new Constraints\NotBlank(),
                        new Constraints\Length(["min" => 4, "max" => 20])
                    ]
                ])
                ->add('email', EmailType::class, [
                    'label' => "Adresse e-mail",
                    'attr' => [
                        "placeholder" => "example@gmail.com"
                    ],
                    'constraints' => [
                        new Constraints\Email,
                        new Constraints\Callback(['CoreBundle\Forms\Validators\AccountEmail', 'validateUnique',])
                    ]
                ])
                ->add('password', RepeatedType::class, [
                    'type' => PasswordType::class,
                    'first_options' => [
                        'label' => 'Mot de passe',
                    ],
                    'second_options' => [
                        'label' => 'Répéter le mot de passe',
                    ],
                    'constraints' => [
                        new Constraints\NotBlank(),
                        new Constraints\Length(["min" => 4])
                    ]
                ])
                ->setAction(\RoutingHelper::generateUrl("register"))
                ->getForm();
    }

    public function setDefaultOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'OC\PlatformBundle\Entity\Advert'
        ));
    }

}
