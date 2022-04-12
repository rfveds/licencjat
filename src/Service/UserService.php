<?php
/**
 * User service.
 */

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;

/**
 * Class UserService.
 */
class UserService
{
    /**
     * User repository.
     */
    private UserRepository $userRepository;

    /**
     * UserService constructor.
     *
     * @param \App\Repository\UserRepository          $userRepository User repository
     * @param \Knp\Component\Pager\PaginatorInterface $paginator      Paginator
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Save user.
     *
     * @param \App\Entity\User $user User entity
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(User $user): void
    {
        $this->userRepository->save($user);
    }

//    /**
//     * Find by email.
//     *
//     * @param string $email Email
//     *
//     * @return \Symfony\Component\Security\Core\User\UserInterface
//     */
//    public function findOneByEmail(string $email): UserInterface
//    {
//        return $this->userRepository->findOneByEmail($email);
//    }

    /**
     * Find user.
     *
     * @param string $email Email
     *
     * @return \App\Entity\User|null
     */
    public function findOneBy(string $email): ?User
    {
        return $this->userRepository->findOneBy(['email' => $email]);
    }
}
