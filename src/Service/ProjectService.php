<?php

/**
 * Project service.
 */

namespace App\Service;

use App\Entity\Project;
use App\Repository\ProjectRepository;
use App\Service\GeneratorService;


/**
 * Class ProjectService.
 */
class ProjectService
{
    /**
     * Project repository.
     */
    private ProjectRepository $projectRepository;


    /**
     * Generator service.
     */
    private GeneratorService $generatorService;

    /**
     * ProjectService constructor.
     *
     * @param \App\Repository\ProjectRepository       $projectRepository Project repository
     */
    public function __construct(ProjectRepository $projectRepository, GeneratorService $generatorService)
    {
        $this->projectRepository = $projectRepository;
        $this->generatorService = $generatorService;
    }

    /**
     * Save project.
     *
     * @param \App\Entity\Project $project Project entity
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Project $project, $tags): void
    {
        //hex
        $baseColor = $this->generatorService->check_color($tags)['hex'];

        //[r,g,b]
        $baseColor = $this->rgbArrToString($this->hexToRGB($baseColor));

        $palette = $this->getPalette($baseColor);

        $project->setLightShades($palette[0]);
        $project->setLightAccent($palette[1]);
        $project->setBaseColor($palette[2]);
        $project->setDarkAccent($palette[3]);
        $project->setDarkShades($palette[4]);


        $this->projectRepository->save($project);
    }

    /**
     * Generate pallete
     */
    public function generate(Project $project): void
    {
        $baseColor = $project->getBaseColor();

        //rgb(r,g,b) => array(r,g,b)

        $baseColor = $this->rgbStringToRgbArray($baseColor);

        //rgb(r,g,b) => [r,g,b]

        $baseColor = $this->rgbArrToString($baseColor);

        $palette = $this->getPalette($baseColor);


        $project->setlightShades($palette[0]);
        $project->setlightAccent($palette[1]);
        $project->setBaseColor($palette[2]);
        $project->setDarkAccent($palette[3]);
        $project->setDarkShades($palette[4]);

        $this->projectRepository->save($project);
    }

    /**
     * Edit colors.
     */
    public function editColors($project, $data): void
    {
        $databaseData = [];

        foreach ($data as $color) {
            //#aaff45 => rgb(r,g,b)
            $color = $this->hexToRGB($color);
            // //rgb(r,g,b) => rgb string
            $color = $this->arrToRGB($color);
            array_push($databaseData, $color);
        }

        $project->setLightShades($databaseData[0]);
        $project->setLightAccent($databaseData[1]);
        $project->setBaseColor($databaseData[2]);
        $project->setDarkAccent($databaseData[3]);
        $project->setDarkShades($databaseData[4]);

        $this->projectRepository->save($project);
    }

    /**
     * Delete element.
     *
     * @param \App\Entity\Project $element Project entity
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(Project $project): void
    {
        $this->projectRepository->delete($project);
    }


    /**
     * Get color palette form Colormind API.
     */
    function getPalette($baseColor)
    {

        $url = 'http://colormind.io/api/';

        // create curl resource
        $ch = curl_init();

        // set url
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt(
            $ch,
            CURLOPT_POSTFIELDS,
            '{
                "input":
                    [
                        "N",
                        "N",
                        ' . $baseColor . ',
                        "N",
                        "N"
                    ],
                "model":"ui"
            }'
        );

        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
        $output = curl_exec($ch);

        // close curl resource to free up system resources
        curl_close($ch);

        //array
        $json = json_decode($output);

        $lightShades = $this->arrToRGB($json->result[0]);
        $lightAccent = $this->arrToRGB($json->result[1]);
        $baseColor = $this->arrToRGB($json->result[2]);
        $darkAccent = $this->arrToRGB($json->result[3]);
        $darkShades = $this->arrToRGB($json->result[4]);

        $palette = [$lightShades, $lightAccent, $baseColor, $darkAccent, $darkShades];

        return $palette;
    }

    function arrToRGB(array $arr)
    {
        return "rgb(" . $arr[0] . "," . $arr[1] .  "," . $arr[2] . ")";
    }

    function hexToRGB($hex, $alpha = false)
    {
        $hex      = str_replace('#', '', $hex);
        $length   = strlen($hex);
        $rgb[0] = hexdec($length == 6 ? substr($hex, 0, 2) : ($length == 3 ? str_repeat(substr($hex, 0, 1), 2) : 0));
        $rgb[1] = hexdec($length == 6 ? substr($hex, 2, 2) : ($length == 3 ? str_repeat(substr($hex, 1, 1), 2) : 0));
        $rgb[2] = hexdec($length == 6 ? substr($hex, 4, 2) : ($length == 3 ? str_repeat(substr($hex, 2, 1), 2) : 0));
        if ($alpha) {
            $rgb['a'] = $alpha;
        }
        return $rgb;
    }

    function rgbArrToString($array)
    {
        return "[" . $array[0] . "," . $array[1] . "," . $array[2] . "]";
    }

    function rgbStringToRgbArray($string)
    {
        $pattern = '/([0-9][0-9][0-9]|[0-9][0-9]|[0-9])/';
        preg_match_all($pattern, $string, $matches);

        $array = [];
        array_unshift($array, array_pop($matches[0]));
        array_unshift($array, array_pop($matches[0]));
        array_unshift($array, array_pop($matches[0]));

        return $array;
    }

    public function rgbToHex()
    {
        return '#ffaabb';
    }
}
