<?php

namespace App\Controller;

use App\Entity\Accidente;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/analisis")
 */
class AnalisisController extends AbstractController
{
    /**
     * @Route("/unidad", name="analisis_unidad")
     */
    public function unidad()
    {
        $user = $this->getUser();
        $funcionario = $user->getFuncionario();
        $unidad = $funcionario->getUnidad();
        $accidentes = $this->getDoctrine()->getRepository(Accidente::class)->findByUnidad($unidad)->getResult();
        $tipoAccidente = $this->getDoctrine()->getRepository(Accidente::class)->getTipoAccidenteUnidad($unidad);

        return $this->render('analisis/unidad.html.twig', [
            'accidentes' => $accidentes,
            'tipoAccidente' => $tipoAccidente,
        ]);
    }

    /**
     * @Route("/funcionario", name="analisis_funcionario")
     */
    public function funcionario()
    {
        return $this->render('analisis/funcionario.html.twig', [
            'controller_name' => 'AnalisisController',
        ]);
    }
}
