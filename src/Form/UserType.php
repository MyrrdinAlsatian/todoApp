<?php

namespace App\Form;

use App\Entity\User;
use PHPUnit\Framework\Test;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',EmailType::class, [
            'label' => "Adresse mail",
            'constraints' => [
                new NotBlank([
                    'message' => "Veuillez entrer votre adresse mail"
                ])
            ],
        ])
            ->add('username', TextType::class, ['label' => "Nom d'utilisateur"])
            ->add('roles')
            ->add('password',RepeatedType::class, [
            // instead of being set onto the object directly,
            // this is read and encoded in the controller
            'type' => PasswordType::class,
            'invalid_message' => " les deux mots de passe doivent correspondre",
            'mapped' => false,
            'attr' => ['autocomplete' => 'new-password'],
            'required' => true,
            'first_options'  => ['label' => 'Mot de passe'],
            'second_options' => ['label' => 'Confirmez votre mot de passe'],
            'constraints' => [
                new NotBlank([
                    'message' => 'Please enter a password',
                ]),
                new Length([
                    'min' => 6,
                    'minMessage' => 'Votre mot de passe doit faire {{ limit }} caracters',
                    // max length allowed by Symfony for security reasons
                    'max' => 4096,
                ]),
            ],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
