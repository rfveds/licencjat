<?php

/**
 * Project entity.
 */

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Project.
 *
 * @ORM\Entity(repositoryClass=ProjectRepository::class)
 * @ORM\Table(name="projects")
 */
class Project
{
    /**
     * Primary key.
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(
     *     type="integer"
     * )
     */
    private int $id;

    /**
     * Title.
     *
     * @ORM\Column(
     *     type="string",
     *     length=255)
     *
     * @Assert\Type(type="string")
     * @Assert\NotBlank
     * @Assert\Length(
     *     min="3",
     *     max="255",
     * )
     */
    private string $title;

    /**
     * Tag.
     *
     * @ORM\ManyToMany(
     *     targetEntity=Tag::class,
     *     inversedBy="projects"
     * )
     *
     * @ORM\JoinTable(
     *     name="projects_tags"
     * )
     */
    private $tags;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class)
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $baseColor;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $color0;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $color1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $color2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $color3;


    /**
     * Project constructor.
     */
    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

    /**
     * Getter for Id.
     *
     * @return int|null Result
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Getter for Title.
     *
     * @return string|null Title
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Setter for Title.
     *
     * @param string $title Title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Tags.
     *
     * @return Collection|Tag[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    /**
     * Add tag.
     *
     * @param Tag $tag Tag
     */
    public function addTag(Tag $tag): void
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
        }
    }

    // /**
    //  * Remove tag.
    //  *
    //  * @param Tag $tag Tag
    //  */
    // public function removeTag(Tag $tag): void
    // {
    //     $this->tags->removeProject($tag);
    // }

    /**
     * Getter for Category.
     * 
     *@return Category|null Code
     */
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    /**
     * Setter for Category.
     *
     * @param Category $category Category
     */
    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getColor0(): ?string
    {
        return $this->color0;
    }

    public function setColor0(?string $color0): self
    {
        $this->color0 = $color0;

        return $this;
    }

    public function getColor1(): ?string
    {
        return $this->color1;
    }

    public function setColor1(?string $color1): self
    {
        $this->color1 = $color1;

        return $this;
    }

    public function getBaseColor(): ?string
    {
        return $this->baseColor;
    }

    public function setBaseColor(?string $baseColor): self
    {
        $this->baseColor = $baseColor;

        return $this;
    }

    public function getColor2(): ?string
    {
        return $this->color2;
    }

    public function setColor2(?string $color2): self
    {
        $this->color2 = $color2;

        return $this;
    }

    public function getColor3(): ?string
    {
        return $this->color3;
    }

    public function setColor3(?string $color3): self
    {
        $this->color3 = $color3;

        return $this;
    }
}
