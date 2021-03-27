<?php

namespace App\Form;

use App\Entity\Cours;
use Doctrine\DBAL\Types\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class CoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('NomCompletCours')
            ->add('NomAbergeCours', ColorType::class)
            ->add('DateDebutCours', \Symfony\Component\Form\Extension\Core\Type\DateTimeType::class, [

                'widget' => 'single_text',])
            ->add('DateFinCours', \Symfony\Component\Form\Extension\Core\Type\DateTimeType::class, [

                'widget' => 'single_text',])


            ->add('Categorie',FileType::class,[
                'label'=>'choisissez votre fichier'
            ])
        ;
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cours::class,
        ]);
    }
}
