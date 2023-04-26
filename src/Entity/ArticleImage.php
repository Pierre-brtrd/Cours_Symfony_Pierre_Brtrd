<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Api\Controller\Images\CreateImageController;
use App\Repository\ArticleImageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ApiResource(
    types: ['https://schema.org/MediaObject'],
    operations: [
        new Get(),
        new Delete(
            openapiContext: [
                'summary' => 'Delete an image',
                'description' => '# Delete Image You can delete an image but **you have to be admin user**.',
            ],
            security: 'is_granted(\'ROLE_ADMIN\')',
            securityMessage: 'Sorry, but you don\'t have the rights to do this.'
        ),
        new GetCollection(),
        new Post(
            controller: CreateImageController::class,
            openapiContext: [
                'requestBody' => [
                    'content' => [
                        'multipart/form-data' => [
                            'schema' => [
                                'type' => 'object',
                                'properties' => [
                                    'imageFile' => ['type' => 'string', 'format' => 'binary'],
                                    'article' => ['type', 'integer', 'format' => 'id'],
                                ],
                            ],
                            'example' => [
                                '@context' => 'string',
                                '@id' => 'string',
                                '@type' => 'string',
                                'imageFile' => 'file',
                                'article' => '/api/articles/1',
                            ],
                        ],
                    ],
                ],
            ],
            validationContext: [
                'groups' => [
                    'Default',
                    'image_object_create',
                ],
            ],
            deserialize: false
        ),
    ],
    normalizationContext: ['groups' => ['image:read']],
    paginationItemsPerPage: 20
)]
#[ORM\Entity(repositoryClass: ArticleImageRepository::class)]
#[Vich\Uploadable]
class ArticleImage
{
    /**
     * @var int|null
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Article|null
     */
    #[ORM\ManyToOne(cascade: ['persist'], inversedBy: 'articleImages')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['image:post'])]
    private ?Article $article = null;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     */
    #[Vich\UploadableField(mapping: 'articles_image', fileNameProperty: 'imageName', size: 'imageSize')]
    #[Assert\NotNull(groups: ['image_object_create'])]
    #[Groups(['image:post'])]
    private ?File $imageFile = null;

    /**
     * @var string|null
     */
    #[ORM\Column(length: 255)]
    private ?string $imageName = null;

    /**
     * @var string|null
     */
    #[ApiProperty(iris: ['https://schema.org/contentUrl'])]
    #[ORM\JoinColumn(nullable: true)]
    #[Groups(['image:read', 'article:list'])]
    public ?string $imageUrl = null;

    /**
     * @var int|null
     */
    #[ORM\Column]
    private ?int $imageSize = null;

    /**
     * @var \DateTimeImmutable|null
     */
    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return string|null
     */
    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    /**
     * @param string|null $imageName
     *
     * @return $this
     */
    public function setImageName(?string $imageName): self
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getImageSize(): ?int
    {
        return $this->imageSize;
    }

    /**
     * @param int|null $imageSize
     *
     * @return $this
     */
    public function setImageSize(?int $imageSize): static
    {
        $this->imageSize = $imageSize;

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
     * @param File|null $imageFile
     *
     * @return void
     */
    public function setImageFile(?File $imageFile): void
    {
        $this->imageFile = $imageFile;
        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    /**
     * @return File|null
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }
}
