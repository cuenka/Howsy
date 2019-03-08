<?php

namespace App\Tests;

use App\Service\GoogleMapsApi;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class RequestValidatorTest
 * @package App\Tests
 */
class PropertyValidatorTest extends WebTestCase
{
    public function testValidateRequest()
    {
        self::bootKernel();

        // returns the real and unchanged service container
        $container = self::$kernel->getContainer();
        $reqValidator = $container->get('app.service.property_validator');
        $reqValidator->validateRequest([]);

        $this->assertArrayHasKey('postcode', $reqValidator->validateRequest([]));

    }
}
