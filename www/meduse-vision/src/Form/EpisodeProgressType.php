<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use App\Entity\EpisodeProgress;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EpisodeProgressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name', null, [
            'label' => 'Nom du contenu',
            'attr' => ['class' => 'form-control', 'placeholder' => 'Ex: Breaking Bad, Harry Potter...'],
        ])
        ->add('type', ChoiceType::class, [
            'choices' => [
                'Film' => 'Film',
                'Série' => 'Série',
                'Livre' => 'Livre',
                'Saga' => 'Saga',
                'Animé' => 'Animé',
                'Documentaire' => 'Documentaire',
                'Dessin Animé' => 'Dessin Animé',
            ],
            'label' => 'Type de contenu',
            'attr' => ['class' => 'form-select'],
        ])
        ->add('status', ChoiceType::class, [
            'choices' => [
                'Fini' => 'Fini',
                'En cours' => 'En cours',
                'À finir' => 'À finir',
                'Recommencer' => 'Recommencer',
                'En attente' => 'En attente',
            ],
            'label' => 'Statut',
            'attr' => ['class' => 'form-select'],
        ])
        ->add('page', IntegerType::class, [
            'label' => 'Page actuelle (si livre)',
            'required' => false,
            'attr' => ['class' => 'form-control'],
        ])
        ->add('chapter', IntegerType::class, [
            'label' => 'Chapitre actuel (si livre)',
            'required' => false,
            'attr' => ['class' => 'form-control'],
        ])
        ->add('season', IntegerType::class, [
            'label' => 'Saison (si série)',
            'required' => false,
            'attr' => ['class' => 'form-control'],
        ])
        ->add('episode', IntegerType::class, [
            'label' => 'Épisode (si série)',
            'required' => false,
            'attr' => ['class' => 'form-control'],
        ])
        ->add('filmNumber', IntegerType::class, [
            'label' => 'Numéro du film (si saga)',
            'required' => false,
            'attr' => ['class' => 'form-control'],
        ])
        ->add('timerHours', IntegerType::class, [
            'label' => 'Heures arrêtées (si film, série, animé)',
            'required' => false,
            'attr' => ['class' => 'form-control'],
        ])
        ->add('timerMinutes', IntegerType::class, [
            'label' => 'Minutes arrêtées',
            'required' => false,
            'attr' => ['class' => 'form-control'],
        ])
        ->add('platform', null, [
            'label' => 'Plateforme (ex: Netflix, Disney+)',
            'required' => false,
            'attr' => ['class' => 'form-control'],
        ])
        ->add('reminder', DateType::class, [
            'widget' => 'single_text',
            'label' => 'Date de rappel',
            'required' => false,
            'attr' => ['class' => 'form-control'],
        ])
        ->add('notes', null, [
            'label' => 'Notes / Commentaires',
            'required' => false,
            'attr' => ['class' => 'form-control'],
        ])
        ->add('save', SubmitType::class, [
            'label' => 'Enregistrer',
            'attr' => ['class' => 'btn btn-primary w-100 mt-3'],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EpisodeProgress::class,
        ]);
    }
}
