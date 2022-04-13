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
use Symfony\Component\HttpFoundation\Request;

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
    public function generator(Request $request): Response
    {
        $input =
            [
                'radość',
                'wyobrźnia',
                'optymizm',
                'ciekawość'
            ];

        $prefix = '0x';
        $color1 = $request->query->get('color1');
        $color2 = $request->query->get('color2');

        $color1 = substr($color1, 1);

        $color2 = substr($color2, 1);

        echo $color1;
        echo '<br>';
        echo $color2;
        echo '<br>';

        $color1 = hexdec($color1);
        $color2 = hexdec($color2);

        echo $color1;
        echo '<br>';
        echo $color2;
        echo '<br>';


        $contrast = new ColorContrast();
        $contrast->addColors($color1, $color2);
        $combinations = $contrast->getCombinations();
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
                // 'color' => $color,
            ]
        );
    }
}
