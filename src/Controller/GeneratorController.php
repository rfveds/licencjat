<?php

/**
 * Generator controller.
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use ColorContrast\ColorContrast;
use App\Service\GeneratorService;




/**
 * Class GeneratorController.
 *
 * @Route("/generator")
 */
class GeneratorController extends AbstractController
{

    /**
     * Generator service.
     */
    private GeneratorService $generatorService;

    /**
     * GeneratorController constructor.
     *
     * @param \App\Service\RegistrationService $registrationService Registration service
     * @param \App\Service\UserService         $userService         User service
     */
    public function __construct(GeneratorService $generatorService)
    {
        $this->generatorService = $generatorService;
    }

    /**
     * Generator.
     *
     * @Route(
     *     "/",
     *     name="generator",
     * )
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP Response
     */
    public function generator(): Response
    {
        $input =
            [
                'radość',
                'wyobrźnia',
                'optymizm',
                'ciekawość'
            ];

        $contrast = new ColorContrast();
        $contrast->addColors(0xff0000, 0x002200, 0x0022ff, 0xffffff);
        $combinations = $contrast->getCombinations(ColorContrast::MIN_CONTRAST_AAA);
        foreach ($combinations as $combination) {
            printf(
                "#%s on the Background color #%s has a contrast value of %f \n",
                $combination->getForeground(),
                $combination->getBackground(),
                $combination->getContrast()
            );
            echo '<br>';
        }

        $color = $this->generatorService->check_color($input)['color'];



        return $this->render(
            'generator/index.html.twig',
            [
                'color' => $color,
                'input' => $input,
            ]
        );
    }
}
