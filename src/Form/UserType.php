<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Votre Email:',
                'required' => true
            ])
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Utilisateur' => 'ROLE_USER',
                    'Éditeur' => 'ROLE_EDITOR',
                    'Administrateur' => 'ROLE_ADMIN'
                ],
                'label' => 'Roles:',
                'required' => false,
                'expanded' => true,
                'multiple' => true,
            ])
            ->add('password', PasswordType::class, [
                'mapped' => false,
                'required' => false,
                /* 'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez rentrer un mot de passe'
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit faire au moins {{ limit }} caractères',
                        'max' => 100
                    ])
                ] */
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Prénom:',
                'required' => true
            ])
            ->add('nom', TextType::class, [
                'label' => 'Nom:',
                'required' => true
            ])
            ->add('address', TextType::class, [
                'label' => 'Adresse:',
                'required' => true
            ])
            ->add('zipCode', IntegerType::class, [
                'label' => 'Code postal:',
                'required' => true
            ])
            ->add('ville', TextType::class, [
                'label' => 'Ville:',
                'required' => true
            ])
            ->add('imageFile', VichImageType::class, [
                'label' => 'Image: ',
                'required' => false,
                'download_uri' => false,
                'image_uri' => true,
                'by_reference' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
