<?php
/**
 * Product Controller.
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ProductController.
 *
 * @Route("/")
 */
class ProductController extends AbstractController
{
    /**
     * Product page.
     *
     * @Route(
     *     "/product",
     *     name="product",
     * )
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP Response
     */
    public function product_page(): Response
    {
        return $this->render(
            'editor/product.html.twig',
        );
    }
}
