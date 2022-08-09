<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Api\Controller\Comments\CommentCreateController;
use App\Repository\CommentsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Annotation\Context;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;

#[ORM\Entity(repositoryClass: CommentsRepository::class)]
#[ApiResource(
    collectionOperations: [
        'get' => [
            'normalization_context' => ['groups' => 'comment:list'],
            'openapi_context' => [
                'summary' => 'Get a list of comments',
                'description' => "# Get a list of comments\n\nThe pagination by default it's 10 items.",
            ],
        ],
        'post' => [
            'controller' => CommentCreateController::class,
            'normalization_context' => ['groups' => 'comment:post'],
            'openapi_context' => [
                'summary' => 'Create a comment for article',
                'description' => "# Create comment for article\n\nYou can create a comment but you have to get an id of article or the IRI article object",
                'requestBody' => [
                    'content' => [
                        'application/ld+json' => [
                            'schema' => [
                                'type' => 'object',
                                'properties' => [
                                    'titre' => ['type' => 'string'],
                                    'content' => ['type' => 'string'],
                                    'note' => ['type' => 'integer'],
                                    'active' => ['type' => 'boolean'],
                                    'rgpd' => ['type' => 'boolean'],
                                    'article' => [
                                        'type' => 'string',
                                        'format' => 'iri',
                                    ],
                                ],
                            ],
                            'example' => [
                                'titre' => 'Great Title',
                                'content' => 'It\'s a great comment example',
                                'note' => 5,
                                'active' => true,
                                'rgpd' => true,
                                'article' => '/api/articles/{id}',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    itemOperations: [
        'get' => [
            'normalization_context' => ['groups' => ['comment:list']],
            'openapi_context' => [
                'summary' => 'Get a comment',
                'description' => "# Get One comment\n\nYou can retrieve one public comment.",
            ],
        ],
        'put' => [
            'normalization_context' => ['groups' => ['comment:put']],
            'security' => "is_granted('EDIT_COMMENT', object)",
            'security_message' => 'Sorry, but you are not the comment owner.',
            'openapi_context' => [
                'summary' => 'Modify a comment',
                'description' => "# Modify comment\n\nYou can modify a comment but you can modify only the comments you have post",
                'requestBody' => [
                    'content' => [
                        'application/ld+json' => [
                            'schema' => [
                                'type' => 'object',
                                'properties' => [
                                    'titre' => ['type' => 'string'],
                                    'content' => ['type' => 'string'],
                                    'note' => ['type' => 'integer'],
                                    'active' => ['type' => 'boolean'],
                                    'rgpd' => ['type' => 'boolean'],
                                    'article' => [
                                        'type' => 'string',
                                        'format' => 'iri',
                                    ],
                                ],
                            ],
                            'example' => [
                                'titre' => 'Great Title Modify',
                                'content' => 'It\'s a great comment example I can modify',
                                'note' => 5,
                                'active' => false,
                                'rgpd' => true,
                                'article' => '/api/articles/{id}',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'delete' => [
            'security' => "is_granted('EDIT_COMMENT', object)",
            'security_message' => 'Sorry, but you are not the comment owner.',
            'openapi_context' => [
                'summary' => 'Delete a comment',
                'description' => "# Delete a comment\n\nYou can delete a comment but **you have to be the owner** of the delete comment.",
            ],
        ],
    ],
    order: ['createdAt' => 'DESC'],
    paginationItemsPerPage: 10,
)]
#[ApiFilter(SearchFilter::class, properties: ['article' => 'exact'])]
class Comments
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    #[Groups(['comment:list'])]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    #[Groups(['comment:list', 'comment:post', 'comment:put'])]
    private ?string $titre = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['comment:list', 'comment:post', 'comment:put'])]
    private ?string $content = null;

    #[ORM\Column]
    #[Gedmo\Timestampable(on: 'create')]
    #[Groups(['comment:list'])]
    #[Context(normalizationContext: [DateTimeNormalizer::FORMAT_KEY => 'Y-m-d H:i'])]
    #[ApiFilter(OrderFilter::class)]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    #[Gedmo\Timestampable(on: 'update')]
    #[Groups(['comment:list'])]
    #[Context(normalizationContext: [DateTimeNormalizer::FORMAT_KEY => 'Y-m-d H:i'])]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column]
    #[Groups(['comment:list', 'comment:post', 'comment:put'])]
    private ?int $note = null;

    #[ORM\Column]
    #[Groups(['comment:list', 'comment:post', 'comment:put'])]
    #[ApiFilter(BooleanFilter::class)]
    private ?bool $active = null;

    #[ORM\Column]
    #[Groups(['comment:list', 'comment:post', 'comment:put'])]
    private ?bool $rgpd = null;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['comment:list'])]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['comment:list'])]
    private ?Article $article = null;

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

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): self
    {
        $this->note = $note;

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

    public function isRgpd(): ?bool
    {
        return $this->rgpd;
    }

    public function setRgpd(bool $rgpd): self
    {
        $this->rgpd = $rgpd;

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

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): self
    {
        $this->article = $article;

        return $this;
    }
}
