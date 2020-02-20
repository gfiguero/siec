<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Entity\Accidente;

use App\Form\AccidenteIdentificacionType;
use App\Form\AccidenteCausasType;
use App\Form\AccidenteCondicionesType;
use App\Form\AccidenteUbicacionType;
use App\Form\AccidenteVehiculosType;
use App\Form\AccidentePeatonesType;

/**
 * @Route("/siec")
 */
class SiecController extends AbstractController
{
    /**
     * @Route("/", name="siec_index", methods={"GET"})
     */
    public function index(Request $request): Response
    {
        return $this->render('siec/index.html.twig', [
        ]);
    }


    /**
     * @Route("/{id}/resumen", name="siec_accidente_resumen", methods={"GET"})
     */
    public function resumen(Request $request, Accidente $accidente): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $accidente = $entityManager->getRepository(Accidente::class)->getResumen($accidente);

        return $this->render('accidente/resumen.html.twig', [
            'accidente' => $accidente,
        ]);
    }

}
