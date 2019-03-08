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

/**
 * Class MapsApi
 * @package App\Service
 */
abstract class MapsApi implements MapsApiInterface
{
    /**
     * @var mixed
     */
    private $latitude;

    /**
     * @var mixed
     */
    private $longitude;
    /**
     * @return mixed
     */
    abstract public function getLatitude();

    /**
     * @return mixed
     */
    abstract public function getLongitude();

    /**
     * @param mixed $latitude
     */
    public function setLatitude($latitude)
    {
        $this->setLatitude($latitude);
    }

    /**
     * @param mixed $longitude
     */
    public function setLongitude($longitude)
    {
        $this->setLongitude($longitude);
    }
}
