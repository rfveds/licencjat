<?php

/**
 * Tag fixture.
 */

namespace App\DataFixtures;

use App\Entity\Tag;


use Doctrine\Persistence\ObjectManager;

/**
 * Class TagFixtures.
 */
class TagFixtures extends AbstractBaseFixtures
{
    /**
     * Load data.
     *
     * @param ObjectManager $manager Object manager
     */
    public function loadData(ObjectManager $manager): void
    {
        foreach ($this->getData() as $data) {
            $tag = $this->getTag($data);

            $manager->persist($tag);
        }

        $manager->flush();
    }

    private function getTag(array $data)
    {
        return (new Tag())
            ->setName($data['name'])
            ->setColor($this->getReference($data['reference']));
    }

    public function getData()
    {
        return
            [

                [
                    'name' => 'ekscytacja',
                    'reference' => 'red'
                ],
                [
                    'name' => 'piękno',
                    'reference' => 'red'
                ],
                [
                    'name' => 'agresja',
                    'reference' => 'red'
                ],
                [
                    'name' => 'miłość',
                    'reference' => 'red'
                ],
                [
                    'name' => 'ciekawość',
                    'reference' => 'yellow'
                ],
                [
                    'name' => 'optymizm',
                    'reference' => 'yellow'
                ],
                [
                    'name' => 'wyobraźnia',
                    'reference' => 'yellow'
                ],
                [
                    'name' => 'radość',
                    'reference' => 'yellow'
                ],
                [
                    'name' => 'energia',
                    'reference' => 'yellow'
                ],
                [
                    'name' => 'lojalność',
                    'reference' => 'blue'
                ],
                [
                    'name' => 'spokój',
                    'reference' => 'blue'
                ],
                [
                    'name' => 'kompetencje',
                    'reference' => 'blue'
                ],
                [
                    'name' => 'technologia',
                    'reference' => 'blue'
                ],
                [
                    'name' => 'sukces',
                    'reference' => 'green'
                ],
                [
                    'name' => 'nadzieja',
                    'reference' => 'green'
                ],
                [
                    'name' => 'natura',
                    'reference' => 'green'
                ],
                [
                    'name' => 'balans',
                    'reference' => 'green'
                ],
                [
                    'name' => 'pieniądze',
                    'reference' => 'green'
                ],
                [
                    'name' => 'spokój',
                    'reference' => 'green'
                ],
                [
                    'name' => 'wyrafinowanie',
                    'reference' => 'purple'
                ],
                [
                    'name' => 'luksus',
                    'reference' => 'purple'
                ],
                [
                    'name' => 'nowoczesność',
                    'reference' => 'purple'
                ],
                [
                    'name' => 'kreatywność',
                    'reference' => 'orange'
                ],
                [
                    'name' => 'aktywność',
                    'reference' => 'orange'
                ],
                [
                    'name' => 'żywiołowość',
                    'reference' => 'orange'
                ],
                [
                    'name' => 'unikalność',
                    'reference' => 'orange'
                ],
                [
                    'name' => 'trwałość',
                    'reference' => 'brown'
                ],
                [
                    'name' => 'stabilność',
                    'reference' => 'brown'
                ],
                [
                    'name' => 'szczerość',
                    'reference' => 'brown'
                ],
                [
                    'name' => 'tradycja',
                    'reference' => 'brown'
                ],
                [
                    'name' => 'uroda',
                    'reference' => 'pink'
                ],
                [
                    'name' => 'dzieciństwo',
                    'reference' => 'pink'
                ],
                [
                    'name' => 'kobiecość',
                    'reference' => 'pink'
                ],
                [
                    'name' => 'życzliwość',
                    'reference' => 'pink'
                ],
                [
                    'name' => 'wyrafinowanie',
                    'reference' => 'black'
                ],
                [
                    'name' => 'pewność',
                    'reference' => 'black'
                ],
                [
                    'name' => 'powaga',
                    'reference' => 'black'
                ],
                [
                    'name' => 'elegancja',
                    'reference' => 'black'
                ],
                [
                    'name' => 'czystość',
                    'reference' => 'white'
                ],
                [
                    'name' => 'prostota',
                    'reference' => 'white'
                ],
                [
                    'name' => 'spokój',
                    'reference' => 'white'
                ],
                [
                    'name' => 'niewinność',
                    'reference' => 'white'
                ],
                [
                    'name' => 'dojrzałość',
                    'reference' => 'grey'
                ],
                [
                    'name' => 'balans',
                    'reference' => 'grey'
                ],
                [
                    'name' => 'bezpieczenstwo',
                    'reference' => 'grey'
                ]
            ];
    }
    public function getOrder()
    {
        return 2;
    }
}
