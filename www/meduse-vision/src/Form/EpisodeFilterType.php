<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EpisodeFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Tous' => null,
                    'Film' => 'Film',
                    'Série' => 'Série',
                    'Livre' => 'Livre',
                    'Saga' => 'Saga',
                    'Animé' => 'Animé',
                    'Documentaire' => 'Documentaire',
                    'Dessin Animé' => 'Dessin Animé',
                ],
                'label' => 'Type de contenu',
                'required' => false,
                'attr' => ['class' => 'form-select'],
            ])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Tous' => null,
                    'Fini' => 'Fini',
                    'En cours' => 'En cours',
                    'À finir' => 'À finir',
                    'Recommencer' => 'Recommencer',
                    'En attente' => 'En attente',
                ],
                'label' => 'Statut',
                'required' => false,
                'attr' => ['class' => 'form-select'],
            ])
            ->add('reminder', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date de rappel',
                'required' => false,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Filtrer',
                'attr' => ['class' => 'btn btn-primary mt-2'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }

    public function getBlockPrefix(): string
    {
        return ''; // Empêche Symfony d'ajouter un préfixe
    }
}
