<?php

namespace App\Form;

use App\Entity\Cours;
use App\Entity\Inscri;
use App\Entity\Users;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('CourName',EntityType::class,[
                "class"=>Cours::class,
                "choice_label"=>"NomCompletCours"
            ])
            ->add('UserMail',EntityType::class,[
                "class"=>Users::class,
                "choice_label"=>"email"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Inscri::class,
        ]);
    }
}
