<?php

/**
 * Project service.
 */

namespace App\Service;

use App\Entity\Project;
use App\Repository\ProjectRepository;
use MikeAlmond\Color\Color;
use MikeAlmond\Color\CssGenerator;
use MikeAlmond\Color\PaletteGenerator;
use App\Service\GeneratorService;


/**
 * Class ProjectService.
 */
class ProjectService
{
    /**
     * Project repository.
     */
    private ProjectRepository $projectRepository;

    
    /**
     * Generator service.
     */
    private GeneratorService $generatorService;

    /**
     * ProjectService constructor.
     *
     * @param \App\Repository\ProjectRepository       $projectRepository Project repository
     */
    public function __construct(ProjectRepository $projectRepository,GeneratorService $generatorService)
    {
        $this->projectRepository = $projectRepository;
        $this->generatorService = $generatorService;
    }

    /**
     * Save project.
     *
     * @param \App\Entity\Project $project Project entity
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Project $project, $tags): void
    {
       
        $result = $this->generatorService->check_color($tags);

        $baseColor = Color::fromHex($result['hex']);
        $generator = new PaletteGenerator($baseColor);
        $distance  = 30;

        $palette = $generator->triad($distance);
        array_push($palette, $baseColor->darken(20));

        $project->setBaseColor($baseColor);
        $project->setColor0($palette[0]->getHex());
        $project->setColor1($palette[1]->getHex());
        $project->setColor2($palette[2]->getHex());

        $this->projectRepository->save($project);
    }

    /**
     * Delete element.
     *
     * @param \App\Entity\Project $element Project entity
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(Project $project): void
    {
        $this->projectRepository->delete($project);
    }
}
