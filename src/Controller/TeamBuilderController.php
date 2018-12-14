<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TeamBuilderController extends AbstractController
{
    /**
     * @Route("/team/builder", name="team_builder")
     */
    public function index()
    {
        return $this->render('team_builder/index.html.twig', [
            'controller_name' => 'TeamBuilderController',
        ]);
    }
}
