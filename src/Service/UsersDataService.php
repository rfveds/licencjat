<?php
/**
 * UsersData service.
 */

namespace App\Service;

use App\Entity\UsersData;
use App\Repository\UsersDataRepository;

/**
 * Class UsersDataService.
 */
class UsersDataService
{
    /**
     * UsersData repository.
     */
    private UsersDataRepository $usersDataRepository;


    /**
     * UsersDataService constructor.
     *
     * @param \App\Repository\UsersDataRepository     $usersDataRepository UsersData repository
     */
    public function __construct(UsersDataRepository $usersDataRepository)
    {
        $this->usersDataRepository = $usersDataRepository;
    }

    /**
     * Save usersData.
     *
     * @param \App\Entity\UsersData $usersData UsersData entity
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(UsersData $usersData): void
    {
        $this->usersDataRepository->save($usersData);
    }
}
