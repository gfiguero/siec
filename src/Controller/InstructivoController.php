<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class InstructivoController extends AbstractController
{
    /**
     * @Route("/instructivo", name="instructivo")
     */
    public function index()
    {
        return $this->render('instructivo/index.html.twig', [
            'controller_name' => 'InstructivoController',
        ]);
    }
}
