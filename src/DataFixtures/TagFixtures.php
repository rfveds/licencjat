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
                    'name' => 'pobudzenie',
                    'reference' => 'red'
                ],
                [
                    'name' => 'aktywność',
                    'reference' => 'red'
                ],


                [
                    'name' => 'optymizm',
                    'reference' => 'yellow'
                ],
                [
                    'name' => 'radość',
                    'reference' => 'yellow'
                ],


                [
                    'name' => 'wydajność',
                    'reference' => 'blue'
                ],
                [
                    'name' => 'zaufanie',
                    'reference' => 'blue'
                ],
                [
                    'name' => 'kompetencje',
                    'reference' => 'blue'
                ],


                [
                    'name' => 'natura',
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
                    'name' => 'jakość',
                    'reference' => 'purple'
                ],


                [
                    'name' => 'energwtyczność',
                    'reference' => 'orange'
                ],
                [
                    'name' => 'twórczość',
                    'reference' => 'orange'
                ],
                [
                    'name' => 'żywiołowość',
                    'reference' => 'orange'
                ],


                [
                    'name' => 'surowość',
                    'reference' => 'brown'
                ],
                [
                    'name' => 'wsparcie',
                    'reference' => 'brown'
                ],
                [
                    'name' => 'niezawodność',
                    'reference' => 'brown'
                ],



                [
                    'name' => 'kobiecość',
                    'reference' => 'pink'
                ],
      


                [
                    'name' => 'dostojność',
                    'reference' => 'black'
                ],
                [
                    'name' => 'siła',
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
                    'name' => 'niewinność',
                    'reference' => 'white'
                ],


                [
                    'name' => 'neutralność',
                    'reference' => 'grey'
                ],

            ];
    }
    public function getOrder()
    {
        return 2;
    }
}
