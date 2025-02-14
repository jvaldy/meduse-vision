<?php

namespace App\Form;

use App\Entity\NotiFile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NotiFileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Nom du document'])
            ->add('expirationDate', DateType::class, ['widget' => 'single_text', 'label' => 'Date d\'expiration'])

            
            

            ->add('reminderBeforeDays', IntegerType::class, ['required' => false, 'label' => 'Rappel avant (jours)'])
            ->add('reminderAfterDays', IntegerType::class, ['required' => false, 'label' => 'Rappel après (jours)'])
            ->add('description', TextareaType::class, ['required' => false, 'label' => 'Description'])
            // ->add('email', EmailType::class, ['label' => 'Email associé'])

            // ->add('email', TextType::class, [
            //     'label' => 'Email',
            //     'required' => true,
            //     'attr' => ['class' => 'form-control', 'value' => '{{ app.session.get("user_email") }}']
            // ])

            ->add('email', TextType::class, [
                'label' => 'Email',
                'required' => true,
                'attr' => ['class' => 'form-control']
            ])
            


            ->add('file', FileType::class, ['required' => false, 'label' => 'Fichier à stocker'])

            ->add('notes', TextareaType::class, [
                'required' => false,
                'label' => 'Notes / Commentaires',
            ])
            

            ->add('priority', ChoiceType::class, [
                'choices' => ['1' => 1, '2' => 2, '3' => 3, '4' => 4, '5' => 5],
                'label' => 'Priorité'
            ])


            ->add('status', ChoiceType::class, [
                'choices' => [
                    'À renouveler' => 'À renouveler',
                    'Terminé' => 'Terminer',
                    'Oublié' => 'Oublier',
                ],
                'label' => 'Statut du document',
                'attr' => ['class' => 'form-select'],
            ]);


            // ->add('isRenewed', CheckboxType::class, ['required' => false, 'label' => 'Renouvelé ?'])
            // ->add('isArchived', CheckboxType::class, ['required' => false, 'label' => 'Archiver']);
            
            


        }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => NotiFile::class,
        ]);
    }
}
