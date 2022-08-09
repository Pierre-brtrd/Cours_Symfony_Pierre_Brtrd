<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Api\Controller\Articles\ArticleCreateController;
use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Context;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
#[ApiResource(
    collectionOperations: [
        'get' => [
            'normalization_context' => ['groups' => ['article:list']],
            'openapi_context' => [
                'summary' => 'Get a list of articles',
                'description' => "# Retrieve a list of articles\n\nThe default pagination it's 5 items per page.",
            ],
        ],
        'post' => [
            'normalization_context' => ['groups' => ['article:post']],
            'controller' => ArticleCreateController::class,
            'security' => "is_granted('ROLE_ADMIN') or is_granted('ROLE_EDITOR')",
            'security_message' => 'Sorry, but you have to be connected.',
            'openapi_context' => [
                'summary' => 'Post a new article',
                'description' => "# You can create an article\n\nFor create an article you have to authenticate yourself",
                'requestBody' => [
                    'content' => [
                        'application/ld+json' => [
                            'schema' => [
                                'type' => 'object',
                                'properties' => [
                                    'titre' => ['type' => 'string'],
                                    'content' => ['type' => 'string'],
                                    'categories' => [
                                        'type' => 'array',
                                        'format' => 'iri',
                                    ],
                                    'active' => ['type' => 'boolean'],
                                ],
                                'example' => [
                                    'titre' => 'Great Title of Article',
                                    'content' => 'It\'s a great article I write here',
                                    'categories' => [
                                        '/api/categories/1',
                                        '/api/categories/2',
                                    ],
                                    'active' => true,
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    itemOperations: [
        'get' => [
            'normalization_context' => ['groups' => ['article:list', 'article:item']],
            'openapi_context' => [
                'summary' => 'Get an article',
                'description' => "# Get One article\n\nYou can retrieve one public article.",
            ],
        ],
        'put' => [
            'normalization_context' => ['groups' => ['article:put']],
            'security' => "is_granted('EDIT_ARTICLE', object)",
            'security_message' => 'Sorry, but you don\'t have the owernship on this article.',
            'openapi_context' => [
                'summary' => 'Modify an article',
                'description' => "# Edit One article\n\nYou can edit an article but you have to be the owner or administrator rights.",
                'requestBody' => [
                    'content' => [
                        'application/ld+json' => [
                            'schema' => [
                                'type' => 'object',
                                'properties' => [
                                    'titre' => ['type' => 'string'],
                                    'content' => ['type' => 'string'],
                                    'categories' => [
                                        'type' => 'array',
                                        'format' => 'iri',
                                    ],
                                    'active' => ['type' => 'boolean'],
                                ],
                            ],
                            'example' => [
                                'titre' => 'Great New Title of Article',
                                'content' => 'It\'s a great article I edit here',
                                'categories' => [
                                    '/api/categories/1',
                                    '/api/categories/2',
                                ],
                                'active' => true,
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'delete' => [
            'security' => "is_granted('EDIT_ARTICLE', object)",
            'security_message' => 'Sorry, but you don\'t have the owernship on this article.',
            'openapi_context' => [
                'summary' => 'Delete an article',
                'description' => "# Delete Article\n\nYou can delete an article but **you have to be the owner** of the delete comment or an **Admin user**.",
            ],
        ],
    ],
    order: ['createdAt' => 'DESC'],
    paginationItemsPerPage: 5,
)]
#[ApiFilter(SearchFilter::class, properties: [
    'titre' => 'partial',
    'user.prenom' => 'partial',
    'categories.titre' => 'partial',
])]
#[ApiFilter(BooleanFilter::class, properties: ['active'])]
#[UniqueEntity(
    fields: ['titre'],
    message: 'Ce titre est déjà utilisé par un autre article'
)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 150, unique: true)]
    #[Groups(['comment:list', 'article:list', 'article:post', 'article:put'])]
    private ?string $titre = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['article:list', 'article:item', 'article:post', 'article:put'])]
    #[Assert\Length(
        min: 10,
        minMessage: 'Le contenu de l\'article ne peut être inférieur à {{ limit }} caractères.'
    )]
    private ?string $content = null;

    #[ORM\Column(length: 150, unique: true)]
    #[Gedmo\Slug(fields: ['titre'])]
    private $slug;

    #[ORM\Column]
    #[Gedmo\Timestampable(on: 'create')]
    #[Groups(['article:list'])]
    #[Context(normalizationContext: [DateTimeNormalizer::FORMAT_KEY => 'Y-m-d H:i'])]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    #[Gedmo\Timestampable(on: 'update')]
    #[Groups(['article:list'])]
    #[Context(normalizationContext: [DateTimeNormalizer::FORMAT_KEY => 'Y-m-d H:i'])]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'articles')]
    #[ORM\JoinColumn(nullable: true)]
    #[Groups(['article:list'])]
    private ?User $user = null;

    #[ORM\ManyToMany(targetEntity: Categorie::class, mappedBy: 'articles', cascade: ['persist'])]
    #[Groups(['article:list', 'article:post', 'article:put'])]
    private Collection $categories;

    #[ORM\OneToMany(mappedBy: 'article', targetEntity: Comments::class, orphanRemoval: true)]
    private Collection $comments;

    #[ORM\OneToMany(mappedBy: 'article', targetEntity: ArticleImage::class, orphanRemoval: true, cascade: ['persist'])]
    #[Groups(['article:list', 'image:post'])]
    #[ApiProperty(iri: 'https://schema.org/image')]
    private Collection $articleImages;

    #[ORM\Column]
    #[Groups(['article:list', 'article:post', 'article:put'])]
    private ?bool $active = null;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->articleImages = new ArrayCollection();
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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Categorie>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Categorie $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->addArticle($this);
        }

        return $this;
    }

    public function removeCategory(Categorie $category): self
    {
        if ($this->categories->removeElement($category)) {
            $category->removeArticle($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Comments>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comments $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setArticle($this);
        }

        return $this;
    }

    public function removeComment(Comments $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getArticle() === $this) {
                $comment->setArticle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ArticleImage>
     */
    public function getArticleImages(): Collection
    {
        return $this->articleImages;
    }

    public function addArticleImage(ArticleImage $articleImage): self
    {
        if (!$this->articleImages->contains($articleImage)) {
            $this->articleImages[] = $articleImage;
            $articleImage->setArticle($this);
        }

        return $this;
    }

    public function removeArticleImage(ArticleImage $articleImage): self
    {
        if ($this->articleImages->removeElement($articleImage)) {
            // set the owning side to null (unless already changed)
            if ($articleImage->getArticle() === $this) {
                $articleImage->setArticle(null);
            }
        }

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
