<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security;
use Vich\UploaderBundle\Form\Type\VichImageType;

class UserType extends AbstractType
{
    public function __construct(private Security $security)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $user = $event->getData();
            $form = $event->getForm();

            if ($user == $this->security->getUser()) {
                $form
                    ->add('prenom', TextType::class, [
                        'label' => 'form.user.fields.firstname',
                        'required' => true,
                    ])
                    ->add('nom', TextType::class, [
                        'label' => 'form.user.fields.firstname',
                        'required' => true,
                    ])
                    ->add('address', TextType::class, [
                        'label' => 'form.user.fields.address',
                        'required' => true,
                    ])
                    ->add('zipCode', IntegerType::class, [
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

            if ($this->security->isGranted('ROLE_ADMIN')) {
                $form->add('roles', ChoiceType::class, [
                    'choices' => [
                        'form.user.fields.choices.user' => 'ROLE_USER',
                        'form.user.fields.choices.editor' => 'ROLE_EDITOR',
                        'form.user.fields.choices.admin' => 'ROLE_ADMIN',
                    ],
                    'label' => 'form.user.fields.roles',
                    'required' => false,
                    'expanded' => true,
                    'multiple' => true,
                ]);
            }
        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'translation_domain' => 'forms',
        ]);
    }
}
