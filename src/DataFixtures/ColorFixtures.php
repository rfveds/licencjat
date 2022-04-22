<?php
/**
 * Users Data fixture.
 */

namespace App\DataFixtures;

use App\Entity\Color;
use Doctrine\Persistence\ObjectManager;

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
        $colors = ['red', 'yellow', 'blue', 'green', 'purple', 'orange', 'brown', 'black', 'white', 'grey' ];

        for ($i = 0; $i < 10; $i++){
            $color = new Color();
            $color->setName($colors[$i]);
            $manager->persist($color);
        }
        

        $manager->flush();
    }
}
