<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Vich\UploaderBundle\Form\Type\VichImageType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'form.user.fields.email',
                'required' => true,
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'attr' => ['autocomplete' => 'new-password'],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'form.user.validator.password.not_blank',
                        ]),
                        new Length([
                            'min' => 6,
                            'minMessage' => 'form.user.validator.password.min_length',
                            // max length allowed by Symfony for security reasons
                            'max' => 4096,
                        ]),
                    ],
                    'label' => 'form.user.fields.password.main',
                ],
                'second_options' => [
                    'attr' => ['autocomplete' => 'new-password'],
                    'label' => 'form.user.fields.password.repeat',
                ],
                'invalid_message' => 'form.user.validator.password.no_match',
                // Instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
            ])
            ->add('prenom', TextType::class, [
                'label' => 'form.user.fields.firstname',
                'required' => true,
            ])
            ->add('nom', TextType::class, [
                'label' => 'form.user.fields.lastname',
                'required' => true,
            ])
            ->add('address', TextType::class, [
                'label' => 'form.user.fields.address',
                'required' => true,
            ])
            ->add('zipCode', TextType::class, [
                'label' => 'form.user.fields.zipcode',
                'required' => true,
            ])
            ->add('ville', TextType::class, [
                'label' => 'form.user.fields.city',
                'required' => true,
            ])
            ->add('imageFile', VichImageType::class, [
                'label' => 'form.user.fields.image',
                'required' => false,
                'download_uri' => false,
                'image_uri' => true,
                'by_reference' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'translation_domain' => 'forms',
        ]);
    }
}
