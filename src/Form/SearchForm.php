<?php

namespace App\Form;

use App\Data\SearchData;
use App\Entity\Categorie;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('query', TextType::class, [
            'label' => false,
            'required' => false,
            'attr' => [
                'placeholder' => 'form.filter.fields.search',
            ],
        ])
            ->add('categories', EntityType::class, [
                'label' => false,
                'required' => false,
                'class' => Categorie::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->andWhere('c.active = true')
                        ->orderBy('c.titre', 'ASC');
                },
                'choice_label' => 'titre',
                'expanded' => true,
                'multiple' => true,
            ])
            ->add('active', ChoiceType::class, [
                'label' => false,
                'required' => false,
                'choices' => [
                    'form.filter.fields.yes' => true,
                    'form.filter.fields.no' => false,
                ],
                'expanded' => true,
                'multiple' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchData::class,
            'method' => 'GET',
            'csrf_protection' => false,
            'translation_domain' => 'forms',
        ]);
    }

    public function getBlockPrefix(): string
    {
        return '';
    }
}
