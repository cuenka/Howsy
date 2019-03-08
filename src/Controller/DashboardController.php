<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DashboardController
 * @package App\Controller
 */
class DashboardController extends AbstractController
{
    /**
     * @Route("/", name="dashboard")
     */
    public function index()
    {
        return $this->render('dashboard/index.html.twig', []);
    }

    /**
     * @Route("/list-all", name="dashboard_list_all")
     */
    public function listAll()
    {
        return $this->render('dashboard/list_all.html.twig', []);
    }

    /**
     * @Route("/list-property", name="dashboard_list_property")
     */
    public function listProperty()
    {
        return $this->render('dashboard/list_property.html.twig', []);
    }

    /**
     * @Route("/list-add", name="dashboard_list_add")
     */
    public function addProperty()
    {
        return $this->render('dashboard/list_add.html.twig', []);
    }
}
