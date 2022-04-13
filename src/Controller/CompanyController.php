<?php
/**
 * Comapny Controller.
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CompanyController.
 *
 * @Route("/")
 */
class CompanyController extends AbstractController
{
    /**
     * Company page.
     *
     * @Route(
     *     "/company",
     *     name="company",
     * )
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP Response
     */
    public function company_page(): Response
    {
        return $this->render(
            'editor/company.html.twig',
        );
    }
}
