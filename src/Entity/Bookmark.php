<?php

/*
 * This file is part of BookmarkIt.
 *
 * (c) Loïc Frémont
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Resource\Model\ResourceInterface;
use Symfony\Component\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table("app_bookmark")
 *
 * @ApiResource(
 *     normalizationContext={"groups"={"Default", "Detailed"}},
 *     attributes={"validation_groups"={Bookmark::class, "validationGroups"}},
 *     itemOperations={
 *          "delete",
 *          "get",
 *          "put"
 *     },
 *     collectionOperations={
 *         "get"={
 *             "normalization_context"={"groups"={"Default"}}
 *         },
 *         "post_video"={
 *             "method"="POST",
 *             "path"="/bookmarks/videos",
 *             "controller"=App\Controller\CreateBookmarkVideo::class,
 *         },
 *         "post_photo"={
 *             "method"="POST",
 *             "path"="/bookmarks/photos",
 *             "controller"=App\Controller\CreateBookmarkPhoto::class,
 *         },
 *         "post"={
 *              "validation_groups"={"video", "photo"}
 *         }
 *     })
 */
class Bookmark implements ResourceInterface
{
    use IdentifiableTrait;

    public const TYPE_VIDEO = 'video';
    public const TYPE_PHOTO = 'photo';

    /**
     * @var string|null
     *
     * @ORM\Column(type="string")
     *
     * @Serializer\Groups({"Default", "Detailed"})
     */
    private $type;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank(groups={"video", "photo"})
     *
     * @Serializer\Groups({"Default", "Detailed"})
     */
    private $title;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank(groups={"video", "photo"})
     *
     * @Serializer\Groups({"Default", "Detailed"})
     */
    private $url;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank(groups={"video", "photo"})
     *
     * @Serializer\Groups({"Default", "Detailed"})
     */
    private $authorName;

    /**
     * @var \DateTimeInterface|null
     *
     * @ORM\Column(type="datetime")
     *
     * @Serializer\Groups({"Default", "Detailed"})
     */
    private $addedAt;

    /**
     * @var int|null
     *
     * @ORM\Column(type="integer")
     *
     * @Assert\NotBlank(groups={"video", "photo"})
     *
     * @Serializer\Groups({"Default", "Detailed"})
     */
    private $width;

    /**
     * @var int|null
     *
     * @ORM\Column(type="integer")
     *
     * @Assert\NotBlank(groups={"video", "photo"})
     *
     * @Serializer\Groups({"Default", "Detailed"})
     */
    private $height;

    /**
     * @var int|null
     *
     * @ORM\Column(type="integer", nullable=true)
     *
     * @Assert\NotBlank(groups={"video"})
     *
     * @Serializer\Groups({"Default", "Detailed"})
     */
    private $duration;

    /**
     * BookMark constructor.
     */
    public function __construct()
    {
        $this->addedAt = new \DateTime();
    }

    /**
     * Return dynamic validation groups.
     *
     * @param Bookmark $bookmark Contains the instance of Bookmark to validate.
     *
     * @return string[]
     */
    public static function validationGroups(Bookmark $bookmark)
    {
        return [$bookmark->getType()];
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     */
    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string|null $url
     */
    public function setUrl(?string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return string|null
     */
    public function getAuthorName(): ?string
    {
        return $this->authorName;
    }

    /**
     * @param string|null $authorName
     */
    public function setAuthorName(?string $authorName): void
    {
        $this->authorName = $authorName;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getAddedAt(): ?\DateTimeInterface
    {
        return $this->addedAt;
    }

    /**
     * @param \DateTimeInterface|null $addedAt
     */
    public function setAddedAt(?\DateTimeInterface $addedAt): void
    {
        $this->addedAt = $addedAt;
    }

    /**
     * @return int|null
     */
    public function getWidth(): ?int
    {
        return $this->width;
    }

    /**
     * @param int|null $width
     */
    public function setWidth(?int $width): void
    {
        $this->width = $width;
    }

    /**
     * @return int|null
     */
    public function getHeight(): ?int
    {
        return $this->height;
    }

    /**
     * @param int|null $height
     */
    public function setHeight(?int $height): void
    {
        $this->height = $height;
    }

    /**
     * @return int|null
     */
    public function getDuration(): ?int
    {
        return $this->duration;
    }

    /**
     * @param int|null $duration
     */
    public function setDuration(?int $duration): void
    {
        $this->duration = $duration;
    }
}
