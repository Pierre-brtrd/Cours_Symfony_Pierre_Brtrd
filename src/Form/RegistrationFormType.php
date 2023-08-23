<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'form.user.fields.email.label',
                'attr' => [
                    'placeholder' => 'form.user.fields.email.placeholder',
                ],
                'required' => true,
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'attr' => [
                        'autocomplete' => 'new-password',
                        'placeholder' => 'form.user.fields.password.placeholder',
                    ],
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
                        new Regex(
                            pattern: '/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[^\w\d\s:])([^\s]){8,16}$/',
                            message: 'form.user.password.regex',
                        ),
                    ],
                    'label' => 'form.user.fields.password.main',
                ],
                'second_options' => [
                    'label' => 'form.user.fields.password.repeat',
                    'attr' => [
                        'placeholder' => 'form.user.fields.password.placeholder',
                    ],
                ],
                'invalid_message' => 'form.user.validator.password.no_match',
                // Instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
            ])
            ->add('prenom', TextType::class, [
                'label' => 'form.user.fields.firstname.label',
                'attr' => [
                    'placeholder' => 'form.user.fields.firstname.placeholder',
                ],
                'required' => true,
            ])
            ->add('nom', TextType::class, [
                'label' => 'form.user.fields.lastname.label',
                'attr' => [
                    'placeholder' => 'form.user.fields.lastname.placeholder',
                ],
                'required' => true,
            ])
            ->add('address', TextType::class, [
                'label' => 'form.user.fields.address.label',
                'attr' => [
                    'placeholder' => 'form.user.fields.address.placeholder',
                ],
                'required' => true,
            ])
            ->add('zipCode', TextType::class, [
                'label' => 'form.user.fields.zipcode.label',
                'attr' => [
                    'placeholder' => 'form.user.fields.zipcode.placeholder',
                ],
                'required' => true,
            ])
            ->add('ville', TextType::class, [
                'label' => 'form.user.fields.city.label',
                'attr' => [
                    'placeholder' => 'form.user.fields.city.placeholder',
                ],
                'required' => true,
            ])
            ->add('imageFile', VichImageType::class, [
                'label' => 'form.user.fields.image.label',
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
