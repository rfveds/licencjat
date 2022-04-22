<?php

namespace App\Entity;

use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TagRepository::class)
 */
class Tag
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(
     *  targetEntity=Color::class, 
     *  inversedBy="tags"
     * )
     * @ORM\JoinColumn(
     *  nullable=false
     * )
     */
    private $color;


    /**
     * Projects.
     *
     * @ORM\ManyToMany(
     *     targetEntity=Project::class,
     *     mappedBy="tags"
     * )
     */
    private $projects;

    /**
     * Tag constructor.
     */
    public function __construct()
    {
        $this->projects = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
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

    /**
     * Getter for projects.
     *
     * @return Collection|Project[]
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    /**
     * Add Project.
     *
     * @param \App\Entity\Project $project Project
     */
    public function addProject(Project $project): void
    {
        if (!$this->projects->contains($project)) {
            $this->projects[] = $project;
            $project->addTag($this);
        }
    }

    /**
     * Remove Project.
     *
     * @param \App\Entity\Project $project Project
     */
    public function removeProject(Project $project): void
    {
        if ($this->projects->removeElement($project)) {
            $project->removeTag($this);
        }
    }
}
