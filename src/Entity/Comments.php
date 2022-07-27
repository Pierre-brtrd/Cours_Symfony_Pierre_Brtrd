<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Controller\Api\CommentCreateController;
use App\Repository\CommentsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CommentsRepository::class)]
#[ApiResource(
    collectionOperations: [
        'get' => [
            'normalization_context' => ['groups' => 'comment:list'],
            'openapi_context' => [
                'summary' => 'Récupère une liste de commentaires',
                'description' => "# Permet de récupérer une liste de commentaires\n\nLa pagination par défaut est à 5 items.",
            ],
        ],
        'post' => [
            'controller' => CommentCreateController::class,
            'normalization_context' => ['groups' => 'comment:post'],
        ],
    ],
    itemOperations: [
        'get' => ['normalization_context' => ['groups' => ['comment:list', 'comment:item']]],
        'put' => [
            'normalization_context' => ['groups' => ['comment:list', 'comment:post']],
            'security' => "is_granted('EDIT_COMMENT', object)",
        ],
        'delete' => [
            'security' => "is_granted('EDIT_COMMENT', object)",
        ],
    ],
    order: ['createdAt' => 'DESC'],
    paginationItemsPerPage: 5,
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
    #[Groups(['comment:list', 'comment:post'])]
    private ?string $titre = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['comment:list', 'comment:post'])]
    private ?string $content = null;

    #[ORM\Column]
    #[Gedmo\Timestampable(on: 'create')]
    #[Groups(['comment:list'])]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    #[Gedmo\Timestampable(on: 'update')]
    #[Groups(['comment:list'])]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column]
    #[Groups(['comment:list', 'write:comment'])]
    private ?int $note = null;

    #[ORM\Column]
    #[Groups(['comment:list', 'write:comment'])]
    private ?bool $active = null;

    #[ORM\Column]
    #[Groups(['comment:list', 'write:comment'])]
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
