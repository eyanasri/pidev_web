<?php

namespace App\Form;

use App\Entity\Skills;
use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('nom')
            ->add('prenom')
            ->add('adress')
            ->add('datenais')
            ->add('discription')
            ->add('boulot')
            ->add('experience')
            ->add('image')
            ->add('lien_fb')
            ->add('lien_twitter')
            ->add('lien_linkedin')

            ->add('roles', ChoiceType ::class, [
                'choices' => [
                    'Utilisateur' => 'ROLE_USER',
                    'Formateur' => 'ROLE_FORMATEUR',
                    'Recruteur' => 'ROLE_RECRUTEUR',

                ],
                'expanded' => false,
                'multiple' => true,
                'label' => 'Rôles :'
            ])
            ->add('sexe', ChoiceType ::class, [
                'choices' => [
                    'Femme' => 'Femme',
                    'Homme' => 'Homme',

                ],
                'label' => 'Sexe :'
            ])

            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
