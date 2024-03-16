<?php

namespace App\Form;

use App\Entity\ActivitePhysique;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActivitePhysiqueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Marche' => 'Marche',
                    'Course à pied' => 'Course à pied',
                    'Natation' => 'Natation',
                    'Cyclisme' => 'Cyclisme',
                    // Ajoutez d'autres types d'activités physique ici
                ],
                'label' => 'Type d\'activité',
                'required' => true,
            ])
            ->add('date', DateType::class, [
                'label' => 'Date',
                'required' => true,
            ])
            ->add('duree', IntegerType::class, [
                'label' => 'Durée (en minutes)',
                'required' => true,
            ])
            ->add('distance', IntegerType::class, [
                'label' => 'Distance (en kilomètres)',
                'required' => false,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ActivitePhysique::class,
        ]);
    }
}
