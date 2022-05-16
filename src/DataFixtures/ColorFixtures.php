<?php

/**
 * Color fixture.
 */

namespace App\DataFixtures;

use App\Entity\Color;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Validator\Constraints\Count;

/**
 * Class ColorFixtures.
 */
class ColorFixtures extends AbstractBaseFixtures
{
    /**
     * Load data.
     *
     * @param ObjectManager $manager Object manager
     */
    public function loadData(ObjectManager $manager): void
    {

        foreach ($this->getData() as $data) {
            $color = $this->getColor($data);

            $this->addReference($data['reference'], $color);

            $manager->persist($color);
        }

        $manager->flush();
    }


    private function getColor(array $data)
    {
        return (new Color())
            ->setName($data['name']);
    }

    private function getData()
    {
        return
            [
                [
                    'name' => 'red',
                    'reference' => 'red'
                ],
                [
                    'name' => 'yellow',
                    'reference' => 'yellow'
                ],
                [
                    'name' => 'blue',
                    'reference' => 'blue'
                ],
                [
                    'name' => 'green',
                    'reference' => 'green'
                ],
                [
                    'name' => 'purple',
                    'reference' => 'purple'
                ],
                [
                    'name' => 'orange',
                    'reference' => 'orange'
                ],
                [
                    'name' => 'brown',
                    'reference' => 'brown'
                ],
                [
                    'name' => 'black',
                    'reference' => 'black'
                ],
                [
                    'name' => 'white',
                    'reference' => 'white'
                ],
                [
                    'name' => 'grey',
                    'reference' => 'grey'
                ],
                [
                    'name' => 'pink',
                    'reference' => 'pink'
                ],
            ];
    }

    public function getOrder()
    {
        return 1;
    }
}
