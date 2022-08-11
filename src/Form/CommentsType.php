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
                'attr' => [
                    'placeholder' => 'form.comments.fields.title.placeholder',
                ],
                'label' => 'form.comments.fields.title.label',
                'required' => true,
                'constraints' => [
                    new Length([
                        'min' => 10,
                        'minMessage' => 'Le titre de votre commentaire doit être supérieur à {{ limit }} caractères',
                        'max' => 150,
                        'maxMessage' => 'Le titre de votre commentaire ne doit pas dépasser {{ limit }} caractères',
                    ]),
                ],
            ])
            ->add('content', TextareaType::class, [
                'label' => 'form.comments.fields.content.label',
                'attr' => [
                    'placeholder' => 'form.comments.fields.content.placeholder',
                ],
                'required' => true,
            ])
            ->add('note', RangeType::class, [
                'label' => 'form.comments.fields.grade.label',
                'attr' => [
                    'min' => 0,
                    'max' => 5,
                    'value' => 3,
                ],
                'help' => 'form.comments.fields.grade.help',
                'required' => true,
            ])
            ->add('rgpd', CheckboxType::class, [
                'label' => 'form.comments.fields.gdpr.label',
                'help' => 'form.comments.fields.gdpr.help',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez cocher la case RGPD pour poster un commentaire',
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comments::class,
            'translation_domain' => 'forms',
        ]);
    }
}
