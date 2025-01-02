<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


// class SignUpType extends AbstractType
// {
//     public function buildForm(FormBuilderInterface $builder, array $options): void
//     {
//         $builder
//             ->add('username', TextType::class, [
//                 'label' => 'Pseudo',
//                 'attr' => ['placeholder' => 'Entrer votre pseudo'],
//             ])
//             ->add('email', EmailType::class, [
//                 'label' => 'Email',
//                 'attr' => ['placeholder' => 'Entrer votre email'],
//             ])
//             ->add('mythology', ChoiceType::class, [
//                 'choices' => $options['mythologies_choices'],
//                 'label' => 'Myth-code',
//                 'placeholder' => '-- Choix du Myth-code --',
//             ])
//             ->add('password', PasswordType::class, [
//                 'label' => 'Mot de passe',
//                 'attr' => ['placeholder' => 'Entrer votre mot de passe'],
//             ])
//             ->add('confirm_password', PasswordType::class, [
//                 'label' => 'Confirmer le mot de passe',
//                 'attr' => ['placeholder' => 'Confirmer votre mot de passe'],
//                 'mapped' => false, // Ce champ ne sera pas lié à l'entité User
//             ])
//             ->add('accept_terms', CheckboxType::class, [
//                 'label' => "Accepter les conditions générales",
//                 'required' => true,
//                 'mapped' => false, // Ce champ ne sera pas lié à l'entité User
//             ])
//             ->add('submit', SubmitType::class, [
//                 'label' => "S'inscrire",
//                 'attr' => ['class' => 'btn btn-primary w-100'],
//             ]);
//     }

//     public function configureOptions(OptionsResolver $resolver): void
//     {
//         $resolver->setDefaults([
//             'mythologies_choices' => [], // Passé dynamiquement depuis le contrôleur
//         ]);
//     }
// }















class SignUpType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'label' => 'Pseudo',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Entrer votre pseudo',
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Entrer votre email',
                ],
            ])
            ->add('mythology', ChoiceType::class, [
                'choices' => $options['mythologies_choices'],
                'label' => 'Myth-code',
                'placeholder' => '-- Choix du Myth-code --',
                'attr' => [
                    'class' => 'form-select',
                ],
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Mot de passe',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Entrer votre mot de passe',
                ],
            ])
            ->add('confirm_password', PasswordType::class, [
                'label' => 'Confirmer le mot de passe',
                'mapped' => false, // Ce champ ne sera pas lié à l'entité User
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Confirmer votre mot de passe',
                ],
            ])
            ->add('accept_terms', CheckboxType::class, [
                'label' => "Accepter les conditions générales",
                'required' => true,
                'mapped' => false, // Ce champ ne sera pas lié à l'entité User
                'attr' => [
                    'class' => 'form-check-input',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => "S'inscrire",
                'attr' => [
                    'class' => 'btn btn-primary w-100',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'mythologies_choices' => [], // Passé dynamiquement depuis le contrôleur
        ]);
    }
}
