<?php

namespace App\Controller;

use App\Entity\Accidente;
use App\Entity\Comuna;
use App\Entity\ClaseAccidente;
use App\Entity\EstadoAccidente;
use App\Form\MensajeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Doctrine\Common\Collections\ArrayCollection;
use Freshcells\SoapClientBundle\SoapClient\SoapClient;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

/**
 * @Route("/mensaje")
 */
class MensajeController extends AbstractController
{
    /**
     * @Route("/", name="mensaje_index")
     */
    public function index(Request $request, PaginatorInterface $paginator)
    {
        $query = $this->getDoctrine()->getRepository(Accidente::class)->findMensajes();
        $page = 1;
        $limit = 50;
        $mensajes = $paginator->paginate($query, $request->query->getInt('page', $page), $limit);

        return $this->render('mensaje/index.html.twig', [
            'mensajes' => $mensajes,
        ]);
    }

    /**
     * @Route("/new", name="mensaje_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $accidente = new Accidente();

        $form = $this->createForm(MensajeType::class, $accidente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $estadoNuevo = $this->getDoctrine()->getRepository(EstadoAccidente::class)->findOneByNombre('Nuevo');
            $accidente->setEstadoAccidente($estadoNuevo);
            $accidente->setEsMensaje(true);
            $accidente->setConcurreSiat(true);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($accidente);
            $entityManager->flush();

            return $this->redirectToRoute('mensaje_index');
        }

        return $this->render('mensaje/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="mensaje_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Accidente $accidente): Response
    {
        $form = $this->createForm(MensajeType::class, $accidente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $accidente->comprobarIncoherencia();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($accidente);
            $entityManager->flush();

            return $this->redirectToRoute('mensaje_index');
        }

        return $this->render('mensaje/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
