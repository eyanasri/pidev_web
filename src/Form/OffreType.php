<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Offre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OffreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('NomEntreprise')
            ->add('Salaire')
            ->add('Description')
            ->add('Localisation')
            ->add('NombreHeure')
            ->add('TypeContrat', ChoiceType::class, [
                'choices' => [
                    'CDI' => 'CDI',
                    'CDD' => 'CDD',
                    'CTT' => 'CIT',
                    'Autre' => 'Autre'
                ]])
            ->add('NiveauEtude')
            ->add('Experience')
            ->add('Langue')
            ->add('DateExpiration')
            ->add('Tel')
            ->add('Email')
            ->add('NomCategorie', EntityType::class, [
                   'class'=>Categorie::class,
                   'choice_label'=>'NomCategorie',
                   'multiple'=>False
               ]
           )
           // ->add('Id_Offre')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Offre::class,
        ]);
    }
}
