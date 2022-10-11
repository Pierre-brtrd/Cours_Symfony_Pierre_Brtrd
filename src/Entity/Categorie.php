<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    operations: [
        new Get(
            normalizationContext: ['groups' => ['tags:list']],
            openapiContext: [
                'summary' => 'Get a Tag',
                'description' => '# Get One Tag You can retrieve one tag.',
            ]
        ),
        new Put(
            normalizationContext: ['groups' => ['tags:post']],
            security: 'is_granted(\'ROLE_ADMIN\')',
            securityMessage: 'Sorry, but you don\'t have the rights for modify a Tag.',
            openapiContext: [
                'requestBody' => [
                    'content' => [
                        'application/ld+json' => [
                            'schema' => [
                                'type' => 'object',
                                'properties' => [
                                    'titre' => ['type' => 'string'],
                                    'active' => ['type' => 'boolean'],
                                ],
                            ],
                            'example' => [
                                'titre' => 'New Tag',
                                'active' => true,
                            ],
                        ],
                    ],
                ],
            ]
        ),
        new Delete(
            security: 'is_granted(\'ROLE_ADMIN\')',
            securityMessage: 'Sorry, but you don\'t have the rights for modify a Tag.',
            openapiContext: [
                'summary' => 'Delete a Tag',
                'description' => '# Delete Tag You can delete a Tag but **you have to be administrator**.',
            ]
        ),
        new GetCollection(
            normalizationContext: ['groups' => ['tags:list']],
            openapiContext: [
                'summary' => 'Get a list of Tags',
                'description' => '# Retrieve a list of tags The default pagination it\'s 10 items per page.',
            ]
        ),
        new Post(
            normalizationContext: ['groups' => ['tags:post']],
            security: 'is_granted(\'ROLE_ADMIN\') or is_granted(\'ROLE_EDITOR\')',
            securityMessage: 'Sorry, but you have to be connected.',
            openapiContext: [
                'summary' => 'Create a Tag',
                'description' => '# Create a tag For create a tag you have to authenticate yourself with an account with the good rights (Admin or Editor).',
                'requestBody' => [
                    'content' => [
                        'application/ld+json' => [
                            'schema' => [
                                'type' => 'object',
                                'properties' => ['titre' => ['type' => 'string'], 'active' => ['type' => 'boolean']],
                            ],
                            'example' => ['titre' => 'New Tag', 'active' => true],
                        ],
                    ],
                ],
            ]
        ),
    ],
    order: ['titre' => 'ASC'],
    paginationItemsPerPage: 10
)]
#[ORM\Entity(repositoryClass: CategorieRepository::class)]
#[UniqueEntity(fields: ['titre'], message: 'Ce titre est déjà utilisé par une autre categorie')]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Groups(['article:list', 'tags:list', 'tags:post'])]
    private ?string $titre = null;

    #[ORM\ManyToMany(targetEntity: Article::class, inversedBy: 'categories', cascade: ['persist'])]
    #[Groups(['tags:list'])]
    private Collection $articles;

    #[ORM\Column]
    #[Groups(['tags:list', 'tags:post'])]
    private ?bool $active = null;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }

    public function __toString()
    {
        /** @var string $titre */
        $titre = $this->titre;

        return $titre;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * @return Collection<int, Article>
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): self
    {
        if ( ! $this->articles->contains($article)) {
            $this->articles[] = $article;
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        $this->articles->removeElement($article);

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }
}
