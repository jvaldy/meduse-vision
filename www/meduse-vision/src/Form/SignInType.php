<?php

namespace App\Form;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;



class SignInType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('myth_code', ChoiceType::class, [
                'choices' => $options['mythologies_choices'],
                'label' => 'Myth-code',
                'placeholder' => '-- Choix du Myth-code --',
                'attr' => [
                    'class' => 'form-select',
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Entrer votre email',
                ],
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Mot de passe',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Entrer votre mot de passe',
                ],
            ])
            ->add('remember_me', CheckboxType::class, [
                'label' => 'Se souvenir de moi',
                'required' => false,
                'attr' => [
                    'class' => 'form-check-input',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Se connecter',
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



