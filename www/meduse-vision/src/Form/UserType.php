<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email',
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Mot de passe',
            ])
            ->add('mythology', ChoiceType::class, [
                'label' => 'Myth-code',
                'choices' => $options['mythologies'], // Passé depuis le contrôleur
                'choice_label' => function ($mythology) {
                    return $mythology->getName() . ' (' . $mythology->getCategory() . ')';
                },
                'choice_value' => 'id',
                'placeholder' => '-- Choix du Myth-code --',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'mythologies' => [],
        ]);
    }
}
