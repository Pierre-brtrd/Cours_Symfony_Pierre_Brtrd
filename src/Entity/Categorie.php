<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Delete;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ApiResource(
    operations: [
        new Get(
            openapiContext: [
                'summary' => 'Get a Tag',
                'description' => '# Get One Tag You can retrieve one tag.',
            ],
            normalizationContext: ['groups' => ['tags:list']]
        ),
        new Put(
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
            ],
            normalizationContext: ['groups' => ['tags:post']],
            security: 'is_granted(\'ROLE_ADMIN\')',
            securityMessage: 'Sorry, but you don\'t have the rights for modify a Tag.'
        ),
        new Delete(
            openapiContext: [
                'summary' => 'Delete a Tag',
                'description' => '# Delete Tag You can delete a Tag but **you have to be administrator**.',
            ],
            security: 'is_granted(\'ROLE_ADMIN\')',
            securityMessage: 'Sorry, but you don\'t have the rights for modify a Tag.'
        ),
        new GetCollection(
            openapiContext: [
                'summary' => 'Get a list of Tags',
                'description' => '# Retrieve a list of tags The default pagination it\'s 10 items per page.',
            ],
            normalizationContext: ['groups' => ['tags:list']]
        ),
        new Post(
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
            ],
            normalizationContext: ['groups' => ['tags:post']],
            security: 'is_granted(\'ROLE_ADMIN\') or is_granted(\'ROLE_EDITOR\')',
            securityMessage: 'Sorry, but you have to be connected.'
        ),
    ],
    order: ['titre' => 'ASC'],
    paginationItemsPerPage: 10
)]
#[ORM\Entity(repositoryClass: CategorieRepository::class)]
#[UniqueEntity(fields: ['titre'], message: 'Ce titre est déjà utilisé par une autre categorie')]
class Categorie
{
    /**
     * @var int|null
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var string|null
     */
    #[ORM\Column(length: 100)]
    #[Groups(['article:list', 'tags:list', 'tags:post'])]
    #[Assert\Length(
        min: 3,
        max: 100,
        minMessage: 'user.title.length.min',
        maxMessage: 'user.title.length.max'
    )]
    private ?string $titre = null;

    /**
     * @var Collection|ArrayCollection
     */
    #[ORM\ManyToMany(targetEntity: Article::class, inversedBy: 'categories', cascade: ['persist'])]
    #[Groups(['tags:list'])]
    private Collection $articles;

    /**
     * @var bool|null
     */
    #[ORM\Column]
    #[Groups(['tags:list', 'tags:post'])]
    private ?bool $active = null;

    /**
     * Construct of class Categorie.
     */
    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        /** @var string $titre */
        $titre = $this->titre;

        return $titre;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getTitre(): ?string
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     *
     * @return $this
     */
    public function setTitre(string $titre): static
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

    /**
     * @param Article $article
     *
     * @return $this
     */
    public function addArticle(Article $article): static
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
        }

        return $this;
    }

    /**
     * @param Article $article
     *
     * @return $this
     */
    public function removeArticle(Article $article): static
    {
        $this->articles->removeElement($article);

        return $this;
    }

    /**
     * @return bool|null
     */
    public function isActive(): ?bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     *
     * @return $this
     */
    public function setActive(bool $active): static
    {
        $this->active = $active;

        return $this;
    }
}
