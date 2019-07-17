<?php

namespace App\Form;

use App\Entity\Reservation;
use App\Entity\Spectacle;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('spectacle', EntityType::class, [
                'label' => 'Spectacle',
                'class' => Spectacle::class,
                'choice_label' => 'name'])

            ->add('name', TextType::class, [

                'label' => 'Nom'
            ])
            ->add('firstname', TextType::class, [

                'label' => 'Prénom'
            ])

            ->add('mail', EmailType::class, [

                'label' => 'Adresse email'
            ])

            ->add('nbperson', ChoiceType::class, [
                'label' => 'Nombre de personnes',
                'choices'  => [
                    '1' => null,
                    '2' => true,
                    '3' => false,
                    '4' => false,
                    '5' => false,
                    '6' => false,
                    ]


            ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
