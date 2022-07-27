<?php

namespace App\Form;

use App\Entity\Comments;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class CommentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'label' => 'Titre de votre commentaire',
                'required' => true,
                'constraints' => [
                    new Length([
                        'min' => 10,
                        'minMessage' => 'Le titre de votre commentaire doit être supérieur à {{ limit }} caractères',
                        'max' => 150,
                        'maxMessage' => 'Le titre de votre commentaire ne doit pas dépasser {{ limit }} caractères',
                    ])
                ]
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Contenu du commentaire',
                'required' => true,
            ])
            ->add('note', RangeType::class, [
                'attr' => [
                    'min' => 0,
                    'max' => 5,
                ],
                'help' => 'Selectionner une note pour l\'article',
                'required' => true
            ])
            ->add('rgpd', CheckboxType::class, [
                'help' => 'En cochant cette case vous acceptez notre politique de confidentialité',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez cocher la case RGPD pour poster un commentaire'
                    ])
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comments::class,
        ]);
    }
}
