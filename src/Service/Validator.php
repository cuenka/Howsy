<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 24/02/19
 * Time: 15:21
 */

namespace App\Service;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\Boolean;

/**
 * Class Validator
 * @package App\Service
 */
abstract class Validator implements ValidatorInterface
{
    /**
     * @param array $parameters
     * @return array|null
     */
    abstract public function validateRequest(array $parameters): ?array;

    /**
     * Allow letters, numbers and spaces
     * @param string $address
     * @return boolean
     */
    public function isValidAlphanumericAndSpace(string $string): bool
    {
        if (preg_match('/^[a-z0-9 .\-]+$/i', $string)) {
            return true;
        }

        return false;
    }


}
