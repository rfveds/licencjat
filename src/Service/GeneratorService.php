<?php

/**
 * Generator service.
 */

namespace App\Service;


/**
 * Class GeneratorService.
 */
class GeneratorService
{

    public function check_color($input)
    {
        //slowa skojarzone ze slowami
        $red = array(
            'energia',
            'ekscytacja',
            'piękno',
            'dominacja'
        );

        $yellow = array(
            'radość',
            'wyobrźnia',
            'optymizm',
            'ciekawość',
        );

        $blue = array(
            'technologia',
            'kompetencje',
            'spokój',
            'lojalność',
        );

        $green = array(
            'zysk',
            'balans',
            'natura',
            'sukces',
        );

        $purple = array(
            'kobiecość',
            'wyrafinowanie',
            'luksus',
            'nowoczesność',
        );

        $orange = array(
            'kreatywność',
            'aktywność',
            'żywiołowość',
            'unikalność',
        );

        $brown = array(
            'trwałość',
            'stabilność',
            'szczerość',
            'tradycja',
        );

        $black = array(
            'formalny',
            'wyrafinowany',
            'pewność',
            'powaga',
        );

        $white = array(
            'czystość',
            'prostota',
            'spokój',
            'niewinność',
        );

        $grey = array(
            'dojrzałość',
            'balans',
            'bezpieczenstwo',
        );

        //tablica z wartosciami kolorow
        $data[] = array('color' => 'red',      'value' => 0, 'hex' => '123abc');
        $data[] = array('color' => 'yellow',   'value' => 0, 'hex' => '123abc');
        $data[] = array('color' => 'blue',     'value' => 0, 'hex' => '123abc');
        $data[] = array('color' => 'green',    'value' => 0, 'hex' => '123abc');
        $data[] = array('color' => 'purple',   'value' => 0, 'hex' => '123abc');
        $data[] = array('color' => 'orange',   'value' => 0, 'hex' => '123abc');
        $data[] = array('color' => 'brown',    'value' => 0, 'hex' => '123abc');
        $data[] = array('color' => 'black',    'value' => 0, 'hex' => '123abc');
        $data[] = array('color' => 'white',    'value' => 0, 'hex' => '123abc');
        $data[] = array('color' => 'grey',     'value' => 0, 'hex' => '123abc');


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
                $result = $data[$i]['hex'];
                $max = $data[$i]['value'];
            }
        }

        return $result;
    }
}
