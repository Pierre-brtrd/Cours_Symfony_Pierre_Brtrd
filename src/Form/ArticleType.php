<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Categorie;
use App\Form\ArticleImageType;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'label' => 'Titre:',
                'required' => true,
            ])
            ->add('categories', EntityType::class, [
                'class' => Categorie::class,
                'label' => 'Categories:',
                'expanded' => true,
                'multiple' => true,
                'mapped' => true,
                'choice_label' => 'titre',
                'by_reference' => false,
            ])
            ->add('articleImages', CollectionType::class, [
                'entry_type' => ArticleImageType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'delete_empty' => true,
                'prototype' => true,
                'by_reference' => false,
            ])
            ->add('content', CKEditorType::class, [
                'label' => 'Contenu:',
                'required' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
