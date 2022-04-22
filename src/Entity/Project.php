<?php

/**
 * Project entity.
 */

namespace App\Entity;

use App\Repository\ProjectRepository;
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
     * Code.
     *
     * @ORM\Column(
     *     type="string",
     * )
     */
    private string $code;

    /**
     * @ORM\ManyToOne(targetEntity=Color::class)
     */
    private $color;


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
     * Getter for Code.
     *
     * @return string|null Code
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * Setter for Code.
     *
     * @param string $description Code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    public function getColor(): ?Color
    {
        return $this->color;
    }

    public function setColor(?Color $color): self
    {
        $this->color = $color;

        return $this;
    }

}
