<?php
/**
 * Project service.
 */

namespace App\Service;

use App\Entity\Project;
use App\Repository\ProjectRepository;

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
     * ProjectService constructor.
     *
     * @param \App\Repository\ProjectRepository       $projectRepository Project repository
     */
    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    /**
     * Save element.
     *
     * @param \App\Entity\Project $element Project entity
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Project $project): void
    {
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
