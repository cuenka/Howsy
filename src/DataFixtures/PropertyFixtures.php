<?php

namespace App\DataFixtures;

use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class PropertyFixtures
 */
class PropertyFixtures extends Fixture
{
    /**
     * creation of a few compnay examples for test purposes
     * @return array
     */
    private function getFixtures()
    {
        try {
            $properties = [
                [
                    'addressline1' => 'Buckingham Palace',
                    'addressline2' => 'Westminster',
                    'city' => 'London',
                    'postcode' => 'SW1A 1AA',
                ],
                [
                    'addressline1' => 'Big Ben',
                    'addressline2' => 'Westminster',
                    'city' => 'London',
                    'postcode' => 'SW1A 0AA',
                ],
                [
                    'addressline1' => 'Trafalgar Square',
                    'addressline2' => '',
                    'city' => 'London',
                    'postcode' => 'WC2N 5DN',
                ],
                [
                    'addressline1' => 'Great Russell St',
                    'addressline2' => 'Bloomsbury',
                    'city' => 'London',
                    'postcode' => 'WC1B 3DG',
                ]
            ];
        } catch (\Exception $exception) {
            echo $exception->getMessage();
            return [];
        }

        return $properties;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $properties = $this->getFixtures();

        foreach ($properties as $key => $property) {
            $instanceProperty = new Property();
            $instanceProperty->setAddressLine1($property['addressline1'])
                ->setAddressLine2($property['addressline2'])
                ->setCity($property['city'])
                ->setPostCode($property['postcode']);
            $manager->persist($instanceProperty);
        }

        $manager->flush();
    }
}
