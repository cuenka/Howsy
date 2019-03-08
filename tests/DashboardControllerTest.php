<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 24/02/19
 * Time: 19:54
 */

namespace App\Tests;

use App\Controller\ProviderController;
use App\Entity\Property;
use App\Entity\Employee;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DashboardControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $url = $client->getContainer()->get('router')->generate('dashboard');

        $client->request('GET', $url);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }


    public function testLiastAll()
    {
        $client = static::createClient();
        $url = $client->getContainer()->get('router')->generate('dashboard_list_all');

        $client->request('GET', $url);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

    }

    public function testListAdd()
    {
        $client = static::createClient();
        $url = $client->getContainer()->get('router')->generate('dashboard_list_add');

        $client->request('GET', $url);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testListProperty()
    {
        $client = static::createClient();
        $url = $client->getContainer()->get('router')->generate('dashboard_list_property');

        $client->request('GET', $url);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

    }
}
