<?php

/**
 * Project repository.
 */

namespace App\Repository;

use App\Entity\Project;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class ProjectRepository.
 *
 * @method Project|null find($id, $lockMode = null, $lockVersion = null)
 * @method Project|null findOneBy(array $criteria, array $orderBy = null)
 * @method Project[]    findAll()
 * @method Project[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectRepository extends ServiceEntityRepository
{

    /**
     * ProjectRepository constructor.
     *
     * @param ManagerRegistry $registry Manager registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Project::class);
    }

    /**
     * Save record.
     *
     * @param Project $project Project entity
     *
     * @throws ORMException
     */
    public function save(Project $project): void
    {
        $this->_em->persist($project);
        $this->_em->flush();
    }

    /**
     * Delete record.
     *
     * @param Project $project project entity
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function delete(Project $project): void
    {
        $this->_em->remove($project);
        $this->_em->flush();
    }

    /**
     * Get or create new query builder.
     *
     * @return QueryBuilder Query builder
     */
    private function getOrCreateQueryBuilder(): QueryBuilder
    {
        return null ?? $this->createQueryBuilder('project');
    }
}
