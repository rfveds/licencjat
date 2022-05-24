<?php

/**
 * User controller.
 */

namespace App\Controller;

use App\Entity\User;
use App\Form\UserEmailType;
use App\Form\UserPasswordType;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Security;

/**
 * Class UserController.
 *
 * @Route("/user")
 */
class UserController extends AbstractController
{
    private Security $security;

    /**
     * User service.
     */
    private UserService $userService;

    /**
     * UserController constructor.
     *
     * @param \App\Service\UserService                  $userService User Service
     * @param \Symfony\Component\Security\Core\Security $security    Security
     */
    public function __construct(UserService $userService, Security $security)
    {
        $this->userService = $userService;
        $this->security = $security;
    }


    /**
     * Show current user.
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @Route(
     *     "/show",
     *     methods={"GET"},
     *     name="user_show",
     * )
     */
    public function show(): Response
    {
        $user = $this->security->getUser();


        return $this->render(
            'user/show.html.twig',
            ['user' => $user]
        );
    }

    /**
     * Edit password action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request         HTTP request
     * @param \App\Entity\User                          $user            User entity
     * @param UserPasswordEncoderInterface              $passwordEncoder Password Encoder
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     *
     * @Route(
     *     "/{id}/edit",
     *     methods={"GET", "PUT", "POST"},
     *     requirements={"id": "[1-9]\d*"},
     *     name="user_edit",
     * )
     */
    public function edit(Request $request, User $user, UserPasswordHasherInterface $passwordEncoder): Response
    {
        $form = $this->createForm(UserPasswordType::class, $user);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $password = $passwordEncoder->hashPassword($user, $user->getPassword());
            $user->setPassword($password);

            $this->userService->save($user);

            $this->addFlash('success', 'message_password_changed_successfully');

            return $this->redirectToRoute('homepage');
        }

        return $this->render(
            'user/edit.html.twig',
            [
                'form' => $form->createView(),
                'user' => $user,
            ]
        );
    }

    /**
     * Edit action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request HTTP request
     * @param \App\Entity\User                          $user    User entity
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     *
     * @Route(
     *     "/{id}/edit_email",
     *     methods={"GET", "PUT", "POST"},
     *     requirements={"id": "[1-9]\d*"},
     *     name="user_edit_email",
     * )
     */
    public function editEmail(Request $request, User $user): Response
    {
        $form = $this->createForm(UserEmailType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->userService->save($user);
            $this->addFlash('success', 'message_email_changed_successfully');

            return $this->redirectToRoute('user_show');
        }

        return $this->render(
            'user/editEmail.html.twig',
            [
                'form' => $form->createView(),
                'user' => $user,
            ]
        );
    }
}
