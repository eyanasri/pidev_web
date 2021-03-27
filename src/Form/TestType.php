<?php

namespace App\Form;

use App\Entity\Test;
use App\Entity\Users;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Question1')
            ->add('Reponse1')
            ->add('Question2')
            ->add('Reponse2')
            ->add('Question3')
            ->add('Reponse3')
            ->add('Question4')
            ->add('Reponse4')
            ->add('Question5')
            ->add('Reponse5')
            ->add('id_uesr',EntityType::class,[
                "class"=>Users::class,
                "choice_label"=>"id"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Test::class,
        ]);
    }
}
