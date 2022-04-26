<?php
/**
 * Category fixture.
 */

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;

/**
 * Class CategoryFixtures.
 */
class CategoryFixtures extends AbstractBaseFixtures
{
    /**
     * Load data.
     *
     * @param ObjectManager $manager Object manager
     */
    public function loadData(ObjectManager $manager): void
    {
        $category_product = new Category();
        $category_product->setTitle('Produkt');
        $manager->persist($category_product);

        $category_company = new Category();
        $category_company->setTitle('Firma');
        $manager->persist($category_company);

        $manager->flush();
    }
}
