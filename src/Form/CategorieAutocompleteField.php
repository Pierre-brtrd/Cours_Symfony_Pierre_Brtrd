<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\Autocomplete\Form\AsEntityAutocompleteField;
use Symfony\UX\Autocomplete\Form\ParentEntityAutocompleteType;

#[AsEntityAutocompleteField]
class CategorieAutocompleteField extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'class' => Categorie::class,
            'placeholder' => 'Choisir une categorie',
            'choice_label' => 'titre',
            'multiple' => true,
            'query_builder' => function (CategorieRepository $categorieRepository) {
                return $categorieRepository->createQueryBuilder('c')
                    ->andWhere('c.active = true')
                    ->orderBy('c.titre', 'ASC');
            },
            'by_reference' => false,
            // 'security' => 'ROLE_SOMETHING',
        ]);
    }

    public function getParent(): string
    {
        return ParentEntityAutocompleteType::class;
    }
}
