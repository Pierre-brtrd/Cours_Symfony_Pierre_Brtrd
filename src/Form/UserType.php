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
                        'label' => 'Prénom:',
                        'required' => true,
                    ])
                    ->add('nom', TextType::class, [
                        'label' => 'Nom:',
                        'required' => true,
                    ])
                    ->add('address', TextType::class, [
                        'label' => 'Adresse:',
                        'required' => true,
                    ])
                    ->add('zipCode', IntegerType::class, [
                        'label' => 'Code postal:',
                        'required' => true,
                    ])
                    ->add('ville', TextType::class, [
                        'label' => 'Ville:',
                        'required' => true,
                    ])
                    ->add('imageFile', VichImageType::class, [
                        'label' => 'Image: ',
                        'required' => false,
                        'download_uri' => false,
                        'image_uri' => true,
                        'by_reference' => false,
                    ]);
            }

            if ($this->security->isGranted('ROLE_ADMIN')) {
                $form->add('roles', ChoiceType::class, [
                    'choices' => [
                        'Utilisateur' => 'ROLE_USER',
                        'Éditeur' => 'ROLE_EDITOR',
                        'Administrateur' => 'ROLE_ADMIN',
                    ],
                    'label' => 'Roles:',
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
        ]);
    }
}
