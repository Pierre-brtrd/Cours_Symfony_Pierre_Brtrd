<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Categorie;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'label' => 'form.article.fields.title.label',
                'attr' => [
                    'placeholder' => 'form.article.fields.title.placeholder',
                ],
                'required' => true,
            ])
            ->add('categories', EntityType::class, [
                'class' => Categorie::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->andWhere('c.active = true')
                        ->orderBy('c.titre', 'ASC');
                },
                'label' => 'form.article.fields.tags',
                'multiple' => true,
                'choice_label' => 'titre',
                'by_reference' => false,
            ])
            ->add('content', HiddenType::class)
            ->add('active', CheckboxType::class, [
                'label' => 'form.article.fields.enable',
            ])
            ->add('articleImages', CollectionType::class, [
                'entry_type' => ArticleImageType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'delete_empty' => true,
                'prototype' => true,
                'by_reference' => false,
                'label' => 'form.article.fields.image.multiple',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
            'translation_domain' => 'forms',
        ]);
    }
}
