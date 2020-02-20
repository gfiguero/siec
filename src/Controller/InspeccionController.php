<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/inspeccion")
 */
class InspeccionController extends AbstractController
{
    /**
     * @Route("/index", name="inspeccion_index", methods={"GET"})
     */
    public function index(Request $request): Response
    {
        return $this->render('inspeccion/index.html.twig');
    }

    /**
     * @Route("/vehiculo/filtrar", name="inspeccion_vehiculo_filtrar", methods={"GET", "POST"})
     */
    public function vehiculoFiltrar(Request $request): Response
    {
        $filtros = $this->get('session')->has('filtroInspeccionVehiculo') ? $this->get('session')->get('filtroInspeccionVehiculo') : null;

        $this->manageObjects($filtros);

        $form = $this->createForm(FiltroInspeccionType::class, $filtros);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('session')->set('filtroInspeccionVehiculo', $form->getData());
            return $this->redirectToRoute('inspeccion_vehiculo_index');
        }

        return $this->render('inspeccion/vehiculo/filtrar.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/persona/filtrar", name="inspeccion_persona_filtrar", methods={"GET", "POST"})
     */
    public function personaFiltrar(Request $request): Response
    {
        $filtros = $this->get('session')->has('filtroInspeccionPersona') ? $this->get('session')->get('filtroInspeccionPersona') : null;

        $this->manageObjects($filtros);

        $form = $this->createForm(FiltroPersonaType::class, $filtros);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('session')->set('filtroInspeccionPersona', $form->getData());
            return $this->redirectToRoute('inspeccion_persona_index');
        }

        return $this->render('inspeccion/persona/filtrar.html.twig', [
            'form' => $form->createView(),
        ]);
    }


}
