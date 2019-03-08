<?php

namespace App\Service;

/**
 * Interface of MapsApi in services folder but I was think creating folder "Interface" but for this test it is OK
 * Interface MapsApiInterface
 * @package App\Service
 */
interface MapsApiInterface
{
    /**
     * @return mixed
     */
    public function getLatitude();

    /**
     * @return mixed
     */
    public function getLongitude();
}
