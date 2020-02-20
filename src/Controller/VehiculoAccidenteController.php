<?php

namespace App\Controller;

use App\Entity\VehiculoAccidente;
use App\Form\VehiculoAccidente1Type;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/vehiculo/accidente")
 */
class VehiculoAccidenteController extends AbstractController
{
    /**
     * @Route("/", name="vehiculo_accidente_index", methods={"GET"})
     */
    public function index(): Response
    {
        $vehiculoAccidentes = $this->getDoctrine()
            ->getRepository(VehiculoAccidente::class)
            ->findAll();

        return $this->render('vehiculo_accidente/index.html.twig', [
            'vehiculo_accidentes' => $vehiculoAccidentes,
        ]);
    }

}
