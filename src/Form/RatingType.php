<?php

namespace App\Form;

use App\Entity\Movie;
use App\Entity\Rating;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RatingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('movie', EntityType::class, [ 'class'=>Movie::class])
            ->add('value', ChoiceType::class,
                [ 'label'=>false, 'choices' => [1 => 1, 2=>2 , 3=>3, 4=>4, 5=>5],
                    'placeholder'=>'Select a value'
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Rating::class,
        ]);
    }
}
