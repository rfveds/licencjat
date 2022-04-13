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

        // $color1 = substr($color1, 1);
        // $color1 = $prefix . $color1;

        // $color2 = substr($color2, 1);
        // $color2 = $prefix . $color2;

        // echo $color1;
        // echo '<br>';
        // echo hex2bin($color1);
        // echo '<br>';
        // echo bin2hex($color1);


        function strtohex($string)
        {
            $string = str_split($string);
            foreach ($string as &$char)
                $char = dechex(ord($char));
            return implode('', $string);
        }

        $test = strtohex($color1);
        echo $test;
        echo '<br>';
        echo hex2bin($test);

        // $contrast = new ColorContrast();
        // $contrast->addColors( 0x0022ff, 0xffffff);
        // $combinations = $contrast->getCombinations(ColorContrast::MIN_CONTRAST_AAA);
        // foreach ($combinations as $combination) {
        //     printf(
        //         "#%s on the Background color #%s has a contrast value of %f \n",
        //         $combination->getForeground(),
        //         $combination->getBackground(),
        //         $combination->getContrast()
        //     );
        //     echo '<br>';
        // }

        $color = $this->generatorService->check_color($input)['color'];




        return $this->render(
            'generator/index.html.twig',
            [
                // 'color' => $color,
            ]
        );
    }
}
