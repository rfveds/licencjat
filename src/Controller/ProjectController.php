<?php

/**
 * Project controller.
 */

namespace App\Controller;

use App\Entity\Project;
use App\Form\ColorsType;
use App\Service\ProjectService;
use App\Repository\ProjectRepository;
use Doctrine\ORM\ORMException;
use App\Form\ProjectType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ProjectController.
 *
 * @Route("/project")
 */
class ProjectController extends AbstractController
{
    /**
     * Project service.
     */
    private ProjectService $projectService;

    /**
     * Project repository.
     */
    private ProjectRepository $projectRepository;

    /**
     * ProjectController constructor.
     *
     * @param \App\Service\ProjectService $projectService Project service
     */
    public function __construct(ProjectService $projectService, ProjectRepository $projectRepository)
    {
        $this->projectService = $projectService;
        $this->projectRepository = $projectRepository;
    }

    /**
     * Index Action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request HTTP Request
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/",
     *     name="project_index",
     * )
     */
    public function index(Request $request): Response
    {

        $projects = $this->projectRepository->findAll();

        return $this->render(
            'project/index.html.twig',
            ['projects' => $projects]
        );
    }



    /**
     * Create action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request HTTP Request
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/create",
     *     methods={"GET", "POST"},
     *     name="project_create",
     * )
     *
     * @throws ORMException
     */
    public function create(Request $request): Response
    {
        $project = new Project();
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData()->getTags()->toArray();

            $tags = [];

            foreach ($data as $tag) {
                array_push($tags, $tag->getName());
            }

            $this->projectService->save($project, $tags);

            return $this->redirectToRoute('project_show', ['id' => $project->getId()]);
        }

        return $this->render(
            'project/create.html.twig',
            ['form' => $form->createView()]
        );
    }

    /**
     * Show action.
     *
     * @param \App\Entity\Project $project Project entity
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/{id}",
     *     methods={"GET"},
     *     name="project_show",
     * )
     */
    public function show(Project $project): Response
    {
        if ($project->getCategory()->getTitle() == 'Produkt') {

            return $this->render(
                'editor/product.html.twig',
                ['project' => $project]
            );
        }
        if ($project->getCategory()->getTitle() == 'Firma') {

            return $this->render(
                'editor/company.html.twig',
                ['project' => $project]
            );
        }
    }

    /**
     * Edit action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request HTTP request
     * @param \App\Entity\Project                       $project Project entity
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     *
     * @Route(
     *     "/{id}/edit",
     *     requirements={"id": "[1-9]\d*"},
     *     name="project_edit",
     * )
     *
     */
    public function edit(Request $request, Project $project): Response
    {
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData()->getTags()->toArray();

            $tags = [];

            foreach ($data as $tag) {
                array_push($tags, $tag->getName());
            }

            $this->projectService->save($project, $tags);
            $this->addFlash('success', 'message_updated_successfully');

            return $this->redirectToRoute('project_index');
        }

        return $this->render(
            'project/edit.html.twig',
            [
                'form' => $form->createView(),
                'project' => $project,
            ]
        );
    }

    /**
     * Delete action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request HTTP request
     * @param \App\Entity\Project                       $project Project entity
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     *
     * @Route(
     *     "/{id}/delete",
     *     requirements={"id": "[1-9]\d*"},
     *     name="project_delete",
     * )
     *
     */
    public function delete(Request $request, Project $project): Response
    {
        $form = $this->createForm(FormType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->projectService->delete($project);
            $this->addFlash('success', 'message_deleted_successfully');

            return $this->redirectToRoute('project_index');
        }

        return $this->render(
            'project/delete.html.twig',
            [
                'form' => $form->createView(),
                'project' => $project,
            ]
        );
    }


    /**
     * Edit colors action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request HTTP request
     * @param \App\Entity\Project                       $project Project entity
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     *
     * @Route(
     *     "/{id}/generate_colors",
     *     requirements={"id": "[1-9]\d*"},
     *     name="project_colors_generate",
     * )
     * 
     */
    public function generateColors(Project $project): Response
    {

        $this->projectService->generate($project);

        if ($project->getCategory()->getTitle() == 'Produkt') {

            return $this->render(
                'editor/product.html.twig',
                ['project' => $project]
            );
        }
        if ($project->getCategory()->getTitle() == 'Firma') {

            return $this->render(
                'editor/company.html.twig',
                ['project' => $project]
            );
        }
    }

    /**
     * Edit colors action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request HTTP request
     * @param \App\Entity\Project                       $project Project entity
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     *
     * @Route(
     *     "/{id}/edit_colors",
     *     requirements={"id": "[1-9]\d*"},
     *     name="project_colors_edit",
     * )
     * 
     */
    public function editColors(Request $request, Project $project): Response
    {

        $baseColor = $request->get('baseColor');
        $lightShades = $request->get('lightShades');
        $lightAccent = $request->get('lightAccent');
        $darkAccent = $request->get('darkAccent');
        $darkShades = $request->get('darkShades');

        $data = [$lightShades, $lightAccent, $baseColor, $darkAccent, $darkShades];

        $this->projectService->editColors($project, $data);

        if ($project->getCategory()->getTitle() == 'Produkt') {

            return $this->render(
                'editor/product.html.twig',
                ['project' => $project]
            );
        }
        if ($project->getCategory()->getTitle() == 'Firma') {

            return $this->render(
                'editor/company.html.twig',
                ['project' => $project]
            );
        }
    }
}
