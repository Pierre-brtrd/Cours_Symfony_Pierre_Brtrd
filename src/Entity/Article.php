<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Link;
use ApiPlatform\Metadata\Post;
use Doctrine\DBAL\Types\Types;
use ApiPlatform\Metadata\Delete;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\ArticleRepository;
use Gedmo\Mapping\Annotation as Gedmo;
use ApiPlatform\Metadata\GetCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\Context;
use Symfony\Component\Validator\Constraints as Assert;
use App\Api\Controller\Articles\ArticleCreateController;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;

#[ApiResource(
    operations: [
        new Get(
            openapiContext: [
                'summary' => 'Get an article',
                'description' => '# Get One article You can retrieve one public article.',
            ],
            normalizationContext: ['groups' => ['article:list', 'article:item']]
        ),
        new Put(
            openapiContext: [
                'summary' => 'Modify an article',
                'description' => '# Edit One article You can edit an article but you have to be the owner or administrator rights.',
                'requestBody' => [
                    'content' => [
                        'application/ld+json' => [
                            'schema' => [
                                'type' => 'object',
                                'properties' => [
                                    'titre' => ['type' => 'string'],
                                    'content' => ['type' => 'string'],
                                    'categories' => ['type' => 'array', 'format' => 'iri'],
                                    'active' => ['type' => 'boolean'],
                                ],
                            ],
                            'example' => [
                                'titre' => 'Great New Title of Article',
                                'content' => 'It\'s a great article I edit here',
                                'categories' => ['/api/categories/1', '/api/categories/2'],
                                'active' => true,
                            ],
                        ],
                    ],
                ],
            ],
            normalizationContext: ['groups' => ['article:put']],
            security: 'is_granted(\'EDIT_ARTICLE\', object)',
            securityMessage: 'Sorry, but you don\'t have the owernship on this article.'
        ),
        new Delete(
            openapiContext: [
                'summary' => 'Delete an article',
                'description' => '# Delete Article You can delete an article but **you have to be the owner** of the delete comment or an **Admin user**.',
            ],
            security: 'is_granted(\'EDIT_ARTICLE\', object)',
            securityMessage: 'Sorry, but you don\'t have the owernship on this article.'
        ),
        new GetCollection(
            openapiContext: [
                'summary' => 'Get a list of articles',
                'description' => '# Retrieve a list of articles The default pagination it\'s 5 items per page.',
            ],
            normalizationContext: ['groups' => ['article:list']]
        ),
        new Post(
            controller: ArticleCreateController::class,
            openapiContext: [
                'summary' => 'Post a new article',
                'description' => '# You can create an article. For create an article you have to authenticate yourself',
                'requestBody' => [
                    'content' => [
                        'application/ld+json' => [
                            'schema' => [
                                'type' => 'object',
                                'properties' => [
                                    'titre' => ['type' => 'string'],
                                    'content' => ['type' => 'string'],
                                    'categories' => ['type' => 'array', 'format' => 'iri'],
                                    'active' => ['type' => 'boolean'],
                                ],
                                'example' => [
                                    'titre' => 'Great Title of Article',
                                    'content' => 'It\'s a great article I write here',
                                    'categories' => ['/api/categories/1', '/api/categories/2'],
                                    'active' => true,
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            normalizationContext: ['groups' => ['article:post']],
            security: 'is_granted(\'ROLE_ADMIN\') or is_granted(\'ROLE_EDITOR\')',
            securityMessage: 'Sorry, but you have to be connected.'
        ),
    ],
    order: ['createdAt' => 'DESC'],
    paginationItemsPerPage: 5
)]
#[ORM\Entity(repositoryClass: ArticleRepository::class)]
#[UniqueEntity(fields: ['titre'], message: 'Ce titre est déjà utilisé par un autre article')]
#[ApiFilter(filterClass: SearchFilter::class, properties: [
    'titre' => 'partial',
    'user.prenom' => 'partial',
    'categories.titre' => 'partial',
])]
#[ApiFilter(filterClass: BooleanFilter::class, properties: ['active'])]
#[
    ApiResource(
        uriTemplate: '/categories/{id}/articles',
        operations: [new GetCollection()],
        uriVariables: [
            'id' => new Link(
                fromClass: Categorie::class,
                identifiers: ['id']
            ),
        ],
        status: 200,
        filters: [
            'annotated_app_entity_article_api_platform_core_bridge_doctrine_orm_filter_search_filter',
            'annotated_app_entity_article_api_platform_core_bridge_doctrine_orm_filter_boolean_filter',
        ]
    )
]
class Article
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
    #[ORM\Column(length: 150, unique: true)]
    #[Groups(['comment:list', 'article:list', 'article:post', 'article:put'])]
    #[Assert\Length(
        min: 3,
        max: 150,
        minMessage: 'Le titre de l\'article ne peut être inférieur à {{ limit }} caractères.',
        maxMessage: 'Le titre de l\'article ne peut être supérieur à {{ limit }} caractères.'
    )]
    private ?string $titre = null;

    /**
     * @var string|null
     */
    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['article:list', 'article:item', 'article:post', 'article:put'])]
    #[Assert\Length(min: 10, minMessage: 'Le contenu de l\'article ne peut être inférieur à {{ limit }} caractères.')]
    private ?string $content = null;

    /**
     * @var string|null
     */
    #[ORM\Column(length: 150, unique: true)]
    #[Gedmo\Slug(fields: ['titre'])]
    private ?string $slug;

    /**
     * @var \DateTimeImmutable|null
     */
    #[ORM\Column]
    #[Gedmo\Timestampable(on: 'create')]
    #[Groups(['article:list'])]
    #[Context(normalizationContext: [DateTimeNormalizer::FORMAT_KEY => 'Y-m-d H:i'])]
    private ?\DateTimeImmutable $createdAt = null;

    /**
     * @var \DateTimeImmutable|null
     */
    #[ORM\Column]
    #[Gedmo\Timestampable(on: 'update')]
    #[Groups(['article:list'])]
    #[Context(normalizationContext: [DateTimeNormalizer::FORMAT_KEY => 'Y-m-d H:i'])]
    private ?\DateTimeImmutable $updatedAt = null;

    /**
     * @var User|null
     */
    #[ORM\ManyToOne(inversedBy: 'articles')]
    #[ORM\JoinColumn(nullable: true)]
    #[Groups(['article:list'])]
    private ?User $user = null;

    /**
     * @var Collection
     */
    #[ORM\ManyToMany(targetEntity: Categorie::class, mappedBy: 'articles', cascade: ['persist'])]
    #[Groups(['article:list', 'article:post', 'article:put'])]
    private Collection $categories;

    /**
     * @var Collection
     */
    #[ORM\OneToMany(mappedBy: 'article', targetEntity: Comments::class, orphanRemoval: true)]
    private Collection $comments;

    /**
     * @var Collection
     */
    #[ApiProperty(iris: ['https://schema.org/image'])]
    #[ORM\OneToMany(mappedBy: 'article', targetEntity: ArticleImage::class, cascade: ['persist'], orphanRemoval: true)]
    #[Groups(['article:list', 'image:post'])]
    private Collection $articleImages;

    /**
     * @var bool|null
     */
    #[ORM\Column]
    #[Groups(['article:list', 'article:post', 'article:put'])]
    private ?bool $active = null;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->articleImages = new ArrayCollection();
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
     * @return self
     */
    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string $content
     *
     * @return self
     */
    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * @param string|null $slug
     *
     * @return self
     */
    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeImmutable $createdAt
     *
     * @return $this
     */
    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTimeImmutable $updatedAt
     *
     * @return $this
     */
    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User|null $user
     *
     * @return $this
     */
    public function setUser(?User $user): static
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

    /**
     * @param Categorie $category
     *
     * @return $this
     */
    public function addCategory(Categorie $category): static
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->addArticle($this);
        }

        return $this;
    }

    /**
     * @param Categorie $category
     *
     * @return $this
     */
    public function removeCategory(Categorie $category): static
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

    /**
     * @param Comments $comment
     *
     * @return $this
     */
    public function addComment(Comments $comment): static
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setArticle($this);
        }

        return $this;
    }

    /**
     * @param Comments $comment
     *
     * @return $this
     */
    public function removeComment(Comments $comment): static
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

    /**
     * @param ArticleImage $articleImage
     *
     * @return $this
     */
    public function addArticleImage(ArticleImage $articleImage): static
    {
        if (!$this->articleImages->contains($articleImage)) {
            $this->articleImages[] = $articleImage;
            $articleImage->setArticle($this);
        }

        return $this;
    }

    /**
     * @param ArticleImage $articleImage
     *
     * @return $this
     */
    public function removeArticleImage(ArticleImage $articleImage): static
    {
        if ($this->articleImages->removeElement($articleImage)) {
            // set the owning side to null (unless already changed)
            if ($articleImage->getArticle() === $this) {
                $articleImage->setArticle(null);
            }
        }

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
