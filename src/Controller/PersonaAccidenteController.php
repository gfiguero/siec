<?php

namespace App\Controller;

use App\Entity\PersonaAccidente;
use App\Form\PersonaAccidente1Type;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/persona/accidente")
 */
class PersonaAccidenteController extends AbstractController
{
    /**
     * @Route("/", name="persona_accidente_index", methods={"GET"})
     */
    public function index(): Response
    {
        $personaAccidentes = $this->getDoctrine()
            ->getRepository(PersonaAccidente::class)
            ->findAll();

        return $this->render('persona_accidente/index.html.twig', [
            'persona_accidentes' => $personaAccidentes,
        ]);
    }

}
