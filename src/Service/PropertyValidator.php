<?php

namespace App\Service;

use App\Entity\Property;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class Validator
 * @package App\Service
 */
class PropertyValidator extends Validator
{
    /**
     * @param array $parameters
     * @return array
     */
    public function validateRequest(array $parameters) : array
    {
        $cleanParameters['addressline1'] = (isset($parameters['addressline1']) ? $parameters['addressline1'] : null);
        $cleanParameters['addressline2'] = (isset($parameters['addressline2']) ? $parameters['addressline2'] : null);
        $cleanParameters['city'] = (isset($parameters['city']) ? new \DateTime($parameters['city']) : null);
        $cleanParameters['postcode'] = (isset($parameters['postcode']) ? $parameters['postcode'] : null);

        return $cleanParameters;
    }

    /**
     * @param array $parameters
     * @return array
     */
    public function validateRequestLite(array $parameters) : array
    {
        $cleanParameters = [];

        if (isset($parameters['addressline1'])) {
            $cleanParameters['addressline1'] = $parameters['addressline1'];
        }
        if (isset($parameters['addressline2'])) {
            $cleanParameters['addressline2'] = $parameters['addressline2'];
        }
        if (isset($parameters['city'])) {
            $cleanParameters['city'] = $parameters['city'];
        }
        if (isset($parameters['postcode'])) {
            $cleanParameters['postcode'] = $parameters['postcode'];
        }

        return $cleanParameters;
    }
    

    /**
     * @param array $parameters
     * @return boolean
     */
    public function isValid(array $parameters) : bool
    {
        $parameters = $this->validateRequestLite($parameters);
        // In this case I want to validate that contains alphanumeric characters and spaces
        // It could be the case that address contain special characters, but for this test I will ignore it.
        foreach ($parameters as $parameter) {
            if ($this->isValidAlphanumericAndSpace($parameter) === false) {
                return false;
            }
        }

        return true;
    }
}
