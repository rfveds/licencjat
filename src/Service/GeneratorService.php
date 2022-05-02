<?php

/**
 * Generator service.
 */

namespace App\Service;

use App\DataFixtures\TagFixtures;

/**
 * Class GeneratorService.
 */
class GeneratorService
{
    /**
     * Tag fixtures.
     */
    private TagFixtures $tagDataFixtures;

    /**
     * GeneratorService constructor.
     *
     * @param \App\DataFixtures\TagFixtures       $TagFixtures Tag fixtures
     */
    public function __construct(TagFixtures $tagDataFixtures)
    {
        $this->tagDataFixtures = $tagDataFixtures;
    }

    public function check_color($input)
    {

        $tags = $this->tagDataFixtures->getData();

        $red = [];
        $yellow = [];
        $blue = [];
        $green = [];
        $purple = [];
        $orange = [];
        $brown = [];
        $black = [];
        $white = [];
        $grey = [];

        foreach ($tags as $t) {
            if ($t['reference'] == 'red') {
                array_push($red, $t['name']);
            }
            if ($t['reference'] == 'yellow') {
                array_push($yellow, $t['name']);
            }
            if ($t['reference'] == 'blue') {
                array_push($blue, $t['name']);
            }
            if ($t['reference'] == 'green') {
                array_push($green, $t['name']);
            }
            if ($t['reference'] == 'purple') {
                array_push($purple, $t['name']);
            }
            if ($t['reference'] == 'orange') {
                array_push($orange, $t['name']);
            }
            if ($t['reference'] == 'brown') {
                array_push($brown, $t['name']);
            }
            if ($t['reference'] == 'black') {
                array_push($black, $t['name']);
            }
            if ($t['reference'] == 'white') {
                array_push($white, $t['name']);
            }
            if ($t['reference'] == 'grey') {
                array_push($grey, $t['name']);
            }
        }

        //tablica z wartosciami kolorow
        $data[] = array('color' => 'red',      'value' => 0, 'hex' => 'b42333');
        $data[] = array('color' => 'yellow',   'value' => 0, 'hex' => 'ffe40a');
        $data[] = array('color' => 'blue',     'value' => 0, 'hex' => '053fd4');
        $data[] = array('color' => 'green',    'value' => 0, 'hex' => '439854');
        $data[] = array('color' => 'purple',   'value' => 0, 'hex' => '5428c9');
        $data[] = array('color' => 'orange',   'value' => 0, 'hex' => 'f05422');
        $data[] = array('color' => 'brown',    'value' => 0, 'hex' => '8e4f3f');
        $data[] = array('color' => 'black',    'value' => 0, 'hex' => '160f05');
        $data[] = array('color' => 'white',    'value' => 0, 'hex' => 'fffbfa');
        $data[] = array('color' => 'grey',     'value' => 0, 'hex' => '515150');


        // sprawdzenie z jakim kolroem powiązane są słowa
        for ($j = 0; $j < sizeof($input); $j++) {
            if (in_array($input[$j], $red)) {
                for ($i = 0; $i < sizeof($data); $i++) {
                    if ($data[$i]['color'] == 'red') {
                        $data[$i]['value']++;
                    }
                }
            }
            if (in_array($input[$j], $yellow)) {
                for ($i = 0; $i < sizeof($data); $i++) {
                    if ($data[$i]['color'] == 'yellow') {
                        $data[$i]['value']++;
                    }
                }
            }
            if (in_array($input[$j], $blue)) {
                for ($i = 0; $i < sizeof($data); $i++) {
                    if ($data[$i]['color'] == 'blue') {
                        $data[$i]['value']++;
                    }
                }
            }
            if (in_array($input[$j], $green)) {
                for ($i = 0; $i < sizeof($data); $i++) {
                    if ($data[$i]['color'] == 'green') {
                        $data[$i]['value']++;
                    }
                }
            }
            if (in_array($input[$j], $purple)) {
                for ($i = 0; $i < sizeof($data); $i++) {
                    if ($data[$i]['color'] == 'purple') {
                        $data[$i]['value']++;
                    }
                }
            }
            if (in_array($input[$j], $orange)) {
                for ($i = 0; $i < sizeof($data); $i++) {
                    if ($data[$i]['color'] == 'orange') {
                        $data[$i]['value']++;
                    }
                }
            }
            if (in_array($input[$j], $brown)) {
                for ($i = 0; $i < sizeof($data); $i++) {
                    if ($data[$i]['color'] == 'brown') {
                        $data[$i]['value']++;
                    }
                }
            }
            if (in_array($input[$j], $black)) {
                for ($i = 0; $i < sizeof($data); $i++) {
                    if ($data[$i]['color'] == 'black') {
                        $data[$i]['value']++;
                    }
                }
            }
            if (in_array($input[$j], $white)) {
                for ($i = 0; $i < sizeof($data); $i++) {
                    if ($data[$i]['color'] == 'white') {
                        $data[$i]['value']++;
                    }
                }
            }
            if (in_array($input[$j], $grey)) {
                for ($i = 0; $i < sizeof($data); $i++) {
                    if ($data[$i]['color'] == 'grey') {
                        $data[$i]['value']++;
                    }
                }
            }
        }

        // znajduje kolor z największą ilością dopasowań
        $max = -1;
        $result = [];

        for ($i = 0; $i < sizeof($data); $i++) {
            if ($data[$i]['value'] > $max) {
                $result = $data[$i];
                $max = $data[$i]['value'];
            }
        }

        return $result;
    }
}
