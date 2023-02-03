<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Api\Controller\Comments\CommentCreateController;
use App\Repository\CommentsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Context;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;

/**
 * Class Comment for entity.
 */
#[ApiResource(
    operations: [
        new Get(
            openapiContext: [
                'summary' => 'Get a comment',
                'description' => '# Get One comment You can retrieve one public comment.',
            ],
            normalizationContext: ['groups' => ['comment:list']]
        ),
        new Put(
            openapiContext: [
                'summary' => 'Modify a comment',
                'description' => '# Modify comment You can modify a comment but you can modify only the comments you have post',
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
                                    'article' => ['type' => 'string', 'format' => 'iri'],
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
            normalizationContext: ['groups' => ['comment:put']],
            security: 'is_granted(\'EDIT_COMMENT\', object)',
            securityMessage: 'Sorry, but you are not the comment owner.'
        ),
        new Delete(
            openapiContext: [
                'summary' => 'Delete a comment',
                'description' => '# Delete a comment You can delete a comment but **you have to be the owner** of the delete comment.',
            ],
            security: 'is_granted(\'EDIT_COMMENT\', object)',
            securityMessage: 'Sorry, but you are not the comment owner.'
        ),
        new GetCollection(
            openapiContext: [
                'summary' => 'Get a list of comments',
                'description' => '# Get a list of comments The pagination by default it\'s 10 items.',
            ],
            normalizationContext: ['groups' => 'comment:list']
        ),
        new Post(
            controller: CommentCreateController::class,
            openapiContext: [
                'summary' => 'Create a comment for article',
                'description' => '# Create comment for article You can create a comment but you have to get an id of article or the IRI article object',
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
                                    'article' => ['type' => 'string', 'format' => 'iri'],
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
            normalizationContext: ['groups' => 'comment:post']
        ),
    ],
    order: ['createdAt' => 'DESC'],
    paginationItemsPerPage: 10
)]
#[ORM\Entity(repositoryClass: CommentsRepository::class)]
#[ApiFilter(filterClass: SearchFilter::class, properties: ['article' => 'exact'])]
class Comments
{
    /**
     * @var int|null
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['comment:list'])]
    private ?int $id = null;

    /**
     * @var string|null
     */
    #[ORM\Column(length: 150)]
    #[Groups(['comment:list', 'comment:post', 'comment:put'])]
    private ?string $titre = null;

    /**
     * @var string|null
     */
    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['comment:list', 'comment:post', 'comment:put'])]
    private ?string $content = null;

    /**
     * @var \DateTimeImmutable|null
     */
    #[ORM\Column]
    #[Gedmo\Timestampable(on: 'create')]
    #[Groups(['comment:list'])]
    #[Context(
        normalizationContext: [DateTimeNormalizer::FORMAT_KEY => 'Y-m-d H:i']
    )]
    #[ApiFilter(filterClass: OrderFilter::class)]
    private ?\DateTimeImmutable $createdAt = null;

    /**
     * @var \DateTimeImmutable|null
     */
    #[ORM\Column]
    #[Gedmo\Timestampable(on: 'update')]
    #[Groups(['comment:list'])]
    #[Context(
        normalizationContext: [DateTimeNormalizer::FORMAT_KEY => 'Y-m-d H:i']
    )]
    private ?\DateTimeImmutable $updatedAt = null;

    /**
     * @var int|null
     */
    #[ORM\Column]
    #[Groups(['comment:list', 'comment:post', 'comment:put'])]
    private ?int $note = null;

    /**
     * @var bool|null
     */
    #[ORM\Column]
    #[Groups(['comment:list', 'comment:post', 'comment:put'])]
    #[ApiFilter(filterClass: BooleanFilter::class)]
    private ?bool $active = null;

    /**
     * @var bool|null
     */
    #[ORM\Column]
    #[Groups(['comment:list', 'comment:post', 'comment:put'])]
    private ?bool $rgpd = null;

    /**
     * @var User|null
     */
    #[ORM\ManyToOne(inversedBy: 'comments')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['comment:list'])]
    private ?User $user = null;

    /**
     * @var Article|null
     */
    #[ORM\ManyToOne(inversedBy: 'comments')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['comment:list'])]
    private ?Article $article = null;

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
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string $content
     *
     * @return $this
     */
    public function setContent(string $content): static
    {
        $this->content = $content;

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
     * @return int|null
     */
    public function getNote(): ?int
    {
        return $this->note;
    }

    /**
     * @param int $note
     *
     * @return $this
     */
    public function setNote(int $note): static
    {
        $this->note = $note;

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

    /**
     * @return bool|null
     */
    public function isRgpd(): ?bool
    {
        return $this->rgpd;
    }

    /**
     * @param bool $rgpd
     *
     * @return $this
     */
    public function setRgpd(bool $rgpd): static
    {
        $this->rgpd = $rgpd;

        return $this;
    }

    /**
     * @return User|UserInterface|null
     */
    public function getUser(): User|UserInterface|null
    {
        return $this->user;
    }

    /**
     * @param User|UserInterface|null $user
     *
     * @return $this
     */
    public function setUser(User|UserInterface|null $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Article|null
     */
    public function getArticle(): ?Article
    {
        return $this->article;
    }

    /**
     * @param Article|null $article
     *
     * @return $this
     */
    public function setArticle(?Article $article): static
    {
        $this->article = $article;

        return $this;
    }
}
