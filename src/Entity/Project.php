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
    private $lightShades;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lightAccent;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $darkAccent;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $darkShades;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="projects")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;


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

    public function getLightShades(): ?string
    {
        return $this->lightShades;
    }

    public function setLightShades(?string $lightShades): self
    {
        $this->lightShades = $lightShades;

        return $this;
    }

    public function getLightAccent(): ?string
    {
        return $this->lightAccent;
    }

    public function setLightAccent(?string $lightAccent): self
    {
        $this->lightAccent = $lightAccent;

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

    public function getDarkAccent(): ?string
    {
        return $this->darkAccent;
    }

    public function setDarkAccent(?string $darkAccent): self
    {
        $this->darkAccent = $darkAccent;

        return $this;
    }

    public function getDarkShades(): ?string
    {
        return $this->darkShades;
    }

    public function setDarkShades(?string $darkShades): self
    {
        $this->darkShades = $darkShades;

        return $this;
    }

    public function rgbToHex($string){

        $arr = $this->rgbStringToRgbArray($string);
        $color = sprintf("#%02x%02x%02x", $arr[0], $arr[1], $arr[2]);

        return $color;
    }

    function rgbStringToRgbArray($string)
    {
        $pattern = '/([0-9][0-9][0-9]|[0-9][0-9]|[0-9])/';
        preg_match_all($pattern, $string, $matches);

        $array = [];
        array_unshift($array, array_pop($matches[0]));
        array_unshift($array, array_pop($matches[0]));
        array_unshift($array, array_pop($matches[0]));

        return $array;
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
}
