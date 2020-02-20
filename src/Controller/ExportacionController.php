<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Grupo;

class ExportacionController extends AbstractController
{
    /**
     * @Route("/exportacion", name="exportacion")
     */
    public function index()
    {
        $list = $this->getDoctrine()->getRepository(Grupo::class)->findAll();
        return $this->render('exportacion/index.html.twig', [
            'list' => $list,
        ]);
    }
}
