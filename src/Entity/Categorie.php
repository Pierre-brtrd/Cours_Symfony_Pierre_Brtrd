<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
#[ApiResource(
    collectionOperations: [
        'get' => [
            'normalization_context' => ['groups' => ['tags:list']],
            'openapi_context' => [
                'summary' => 'Get a list of Tags',
                'description' => "# Retrieve a list of tags\n\nThe default pagination it's 10 items per page.",
            ],
        ],
        'post' => [
            'normalization_context' => ['groups' => ['tags:post']],
            'security' => "is_granted('ROLE_ADMIN') or is_granted('ROLE_EDITOR')",
            'security_message' => 'Sorry, but you have to be connected.',
            'openapi_context' => [
                'summary' => 'Create a Tag',
                'description' => "# Create a tag\n\nFor create a tag you have to authenticate yourself with an account with the good rights (Admin or Editor).",
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
        ],
    ],
    itemOperations: [
        'get' => [
            'normalization_context' => ['groups' => ['tags:list']],
            'openapi_context' => [
                'summary' => 'Get a Tag',
                'description' => "# Get One Tag\n\nYou can retrieve one tag.",
            ],
        ],
        'put' => [
            'normalization_context' => ['groups' => ['tags:post']],
            'security' => "is_granted('ROLE_ADMIN')",
            'security_message' => 'Sorry, but you don\'t have the rights for modify a Tag.',
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
        'delete' => [
            'security' => "is_granted('ROLE_ADMIN')",
            'security_message' => 'Sorry, but you don\'t have the rights for modify a Tag.',
            'openapi_context' => [
                'summary' => 'Delete a Tag',
                'description' => "# Delete Tag\n\nYou can delete a Tag but **you have to be administrator**.",
            ],
        ],
    ],
    subresourceOperations: [
        'articles_get_subresource' => [
            'method' => 'GET',
            'path' => '/categories/{id}/articles',
            'openapi_context' => [
                'summary' => 'Get a list of articles by category',
                'description' => "# Get a list Article filter by category\n\nYou can retrieve articles by category with the id of the category.",
            ],
        ],
    ],
    order: ['titre' => 'ASC'],
    paginationItemsPerPage: 10,
)]
#[UniqueEntity(
    fields: ['titre'],
    message: 'Ce titre est déjà utilisé par une autre categorie'
)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Groups(['article:list', 'tags:list', 'tags:post'])]
    private ?string $titre = null;

    #[ORM\ManyToMany(targetEntity: Article::class, inversedBy: 'categories', cascade: ['persist'])]
    #[Groups(['tags:list'])]
    #[ApiSubresource]
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
        return $this->titre;
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
        if (!$this->articles->contains($article)) {
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
