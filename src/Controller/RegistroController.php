<?php

namespace App\Controller;

use App\Entity\Accidente;
use App\Entity\Causa;
use App\Entity\Comuna;
use App\Entity\ClaseAccidente;
use App\Entity\TipoAccidente;
use App\Entity\Unidad;
use App\Entity\Funcionario;
use App\Entity\RegistroEtapa;
use App\Entity\EstadoAccidente;
use App\Form\AccidenteType;
use App\Form\AccidenteIdentificacionType;
use App\Form\AccidenteCausasType;
use App\Form\AccidenteCondicionesType;
use App\Form\AccidenteUbicacionType;
use App\Form\AccidenteVehiculosType;
use App\Form\AccidentePeatonesType;
use App\Form\AccidenteBusquedaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Doctrine\Common\Collections\ArrayCollection;
use Freshcells\SoapClientBundle\SoapClient\SoapClient;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/registro")
 */
class RegistroController extends AbstractController
{
    /**
     * @Route("/unidad", name="registro_unidad_index", methods={"GET"})
     */
    public function unidadIndex(Request $request, PaginatorInterface $paginator): Response
    {
        $page = 1;
        $limit = 50;
        $user = $this->getUser();
        $funcionario = $user->getFuncionario();
        $unidad = $funcionario->getUnidad();
        $query = $this->getDoctrine()->getRepository(Accidente::class)->findByUnidad($unidad);
        $accidentes = $paginator->paginate($query, $request->query->getInt('page', $page), $limit);

        return $this->render('registro/index.html.twig', [
            'accidentes' => $accidentes,
        ]);
    }

    /**
     * @Route("/funcionario", name="registro_funcionario_index", methods={"GET"})
     */
    public function funcionarioIndex(Request $request, PaginatorInterface $paginator): Response
    {
        $page = 1;
        $limit = 50;
        $user = $this->getUser();
        $funcionario = $user->getFuncionario();
        $query = $this->getDoctrine()->getRepository(Accidente::class)->findByFuncionarioResponsable($funcionario);
        $accidentes = $paginator->paginate($query, $request->query->getInt('page', $page), $limit);

        return $this->render('registro/index.html.twig', [
            'accidentes' => $accidentes,
        ]);
    }

    /**
     * @Route("/new", name="registro_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $accidente = new Accidente();
        $user = $this->getUser();

        $funcionarioResponsable = $user->getFuncionario();
        $unidad = $funcionarioResponsable->getUnidad();
        $comuna = $unidad->getComuna();
        $numeroFormulario = $this->getDoctrine()->getRepository(Accidente::class)->obtenerNumeroFormulario($unidad);
        $registroEtapa = $this->getDoctrine()->getRepository(RegistroEtapa::class)->findOneByNombre('Identificación');
        $estadoNuevo = $this->getDoctrine()->getRepository(EstadoAccidente::class)->findOneByNombre('Nuevo');


        $accidente->setFecha(new \DateTime('now'));
        $accidente->setHora(new \DateTime('now'));
        $accidente->setComuna($comuna);
        $accidente->setUnidad($unidad);
        $accidente->setFuncionarioResponsable($funcionarioResponsable);
        $accidente->setNumeroFormulario($numeroFormulario);
        $accidente->setEstadoAccidente($estadoNuevo);
        $accidente->addRegistroEtapa($registroEtapa);

        $form = $this->createForm(AccidenteIdentificacionType::class, $accidente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $accidente->comprobarIncoherencia();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($accidente);
            $entityManager->flush();

            return $this->redirectToRoute('registro_causas', [
                'accidente' => $accidente->getId(),
            ]);
        }

        return $this->render('registro/identificacion.html.twig', [
            'accidente' => $accidente,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{accidente}/accidente/mensaje", name="registro_mensaje", methods={"GET","POST"})
     */
    public function mensaje(Request $request, Accidente $accidente): Response
    {
        if (!$this->verificarPertinencia($accidente)) return $this->redirectToRoute('registro_unidad_index');

        $entityManager = $this->getDoctrine()->getManager();
        $accidente = $entityManager->getRepository(Accidente::class)->getIdentificacion($accidente);

        $user = $this->getUser();
        $funcionario = $user->getFuncionario();
        $unidad = $funcionario->getUnidad();
        $comuna = $unidad->getComuna();
        $numeroFormulario = $this->getDoctrine()->getRepository(Accidente::class)->obtenerNumeroFormulario($unidad);
        $registroEtapa = $this->getDoctrine()->getRepository(RegistroEtapa::class)->findOneByNombre('Identificación');
        $estadoNuevo = $this->getDoctrine()->getRepository(EstadoAccidente::class)->findOneByNombre('Nuevo');

        $accidente->setComuna($comuna);
        $accidente->setUnidad($unidad);
        $accidente->setFuncionarioResponsable($funcionario);
        $accidente->setNumeroFormulario($numeroFormulario);
        $accidente->setEstadoAccidente($estadoNuevo);
        $accidente->addRegistroEtapa($registroEtapa);

        $form = $this->createForm(AccidenteIdentificacionType::class, $accidente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $accidente->comprobarIncoherencia();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($accidente);
            $entityManager->flush();

            return $this->redirectToRoute('registro_causas', [
                'accidente' => $accidente->getId(),
            ]);
        }

        return $this->render('registro/identificacion.html.twig', [
            'accidente' => $accidente,
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/{accidente}/accidente/identificacion", name="registro_identificacion", methods={"GET","POST"})
     */
    public function identificacion(Request $request, Accidente $accidente): Response
    {
        if (!$this->verificarPertinencia($accidente)) return $this->redirectToRoute('registro_unidad_index');
        $registroEtapa = $this->getDoctrine()->getRepository(RegistroEtapa::class)->findOneByNombre('Identificación');

        $entityManager = $this->getDoctrine()->getManager();
        $accidente = $entityManager->getRepository(Accidente::class)->getIdentificacion($accidente);

        $form = $this->createForm(AccidenteIdentificacionType::class, $accidente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $accidente->addRegistroEtapa($registroEtapa);
            $accidente->comprobarIncoherencia();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($accidente);
            $entityManager->flush();

            return $this->redirectToRoute('registro_causas', [
                'accidente' => $accidente->getId(),
            ]);
        }

        return $this->render('registro/identificacion.html.twig', [
            'accidente' => $accidente,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{accidente}/accidente/causas", name="registro_causas", methods={"GET","POST"})
     */
    public function causas(Request $request, Accidente $accidente): Response
    {
        if (!$this->verificarPertinencia($accidente)) return $this->redirectToRoute('registro_unidad_index');

        $form = $this->createForm(AccidenteCausasType::class, $accidente);
        $form->handleRequest($request);

        $entityManager = $this->getDoctrine()->getManager();
        $accidente = $entityManager->getRepository(Accidente::class)->getCausas($accidente);

        if ($form->isSubmitted() && $form->isValid()) {
            $registroEtapa = $this->getDoctrine()->getRepository(RegistroEtapa::class)->findOneByNombre('Causas');
            $accidente->addRegistroEtapa($registroEtapa);
            $accidente->comprobarIncoherencia();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($accidente);
            $entityManager->flush();

            return $this->redirectToRoute('registro_condiciones', [
                'accidente' => $accidente->getId(),
            ]);
        }

        return $this->render('registro/causas.html.twig', [
            'accidente' => $accidente,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{accidente}/accidente/condiciones", name="registro_condiciones", methods={"GET","POST"})
     */
    public function condiciones(Request $request, Accidente $accidente): Response
    {
        if (!$this->verificarPertinencia($accidente)) return $this->redirectToRoute('registro_unidad_index');

        $entityManager = $this->getDoctrine()->getManager();
        $accidente = $entityManager->getRepository(Accidente::class)->getCondiciones($accidente);

        $form = $this->createForm(AccidenteCondicionesType::class, $accidente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $registroEtapa = $this->getDoctrine()->getRepository(RegistroEtapa::class)->findOneByNombre('Condiciones');
            $accidente->addRegistroEtapa($registroEtapa);
            $accidente->comprobarIncoherencia();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($accidente);
            $entityManager->flush();

            return $this->redirectToRoute('registro_ubicacion', [
                'accidente' => $accidente->getId(),
            ]);
        }

        return $this->render('registro/condiciones.html.twig', [
            'accidente' => $accidente,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{accidente}/accidente/ubicacion", name="registro_ubicacion", methods={"GET","POST"})
     */
    public function ubicacion(Request $request, Accidente $accidente): Response
    {
        if (!$this->verificarPertinencia($accidente)) return $this->redirectToRoute('registro_unidad_index');

        $entityManager = $this->getDoctrine()->getManager();
        $accidente = $entityManager->getRepository(Accidente::class)->getUbicacion($accidente);

        $form = $this->createForm(AccidenteUbicacionType::class, $accidente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $registroEtapa = $this->getDoctrine()->getRepository(RegistroEtapa::class)->findOneByNombre('Ubicación');
            $accidente->addRegistroEtapa($registroEtapa);
            $accidente->comprobarIncoherencia();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($accidente);
            $entityManager->flush();

            return $this->redirectToRoute('registro_vehiculos', [
                'accidente' => $accidente->getId(),
            ]);
        }

        return $this->render('registro/ubicacion.html.twig', [
            'accidente' => $accidente,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{accidente}/accidente/vehiculos", name="registro_vehiculos", methods={"GET","POST"})
     */
    public function vehiculos(Request $request, Accidente $accidente): Response
    {
        if (!$this->verificarPertinencia($accidente)) return $this->redirectToRoute('registro_unidad_index');

        $entityManager = $this->getDoctrine()->getManager();
        $accidente = $entityManager->getRepository(Accidente::class)->getVehiculos($accidente);

        $form = $this->createForm(AccidenteVehiculosType::class, $accidente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $registroEtapa = $this->getDoctrine()->getRepository(RegistroEtapa::class)->findOneByNombre('Vehículos y ocupantes');
            $accidente->addRegistroEtapa($registroEtapa);
            $accidente->comprobarIncoherencia();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($accidente);
            $entityManager->flush();

            return $this->redirectToRoute('registro_peatones', [
                'accidente' => $accidente->getId(),
            ]);
        }

        return $this->render('registro/vehiculos.html.twig', [
            'accidente' => $accidente,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{accidente}/accidente/peatones", name="registro_peatones", methods={"GET","POST"})
     */
    public function peatones(Request $request, Accidente $accidente): Response
    {
        if (!$this->verificarPertinencia($accidente)) return $this->redirectToRoute('registro_unidad_index');

        $entityManager = $this->getDoctrine()->getManager();
        $accidente = $entityManager->getRepository(Accidente::class)->getPeatones($accidente);

        $form = $this->createForm(AccidentePeatonesType::class, $accidente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $registroEtapa = $this->getDoctrine()->getRepository(RegistroEtapa::class)->findOneByNombre('Peatones');
            $accidente->addRegistroEtapa($registroEtapa);
            $accidente->comprobarIncoherencia();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($accidente);
            $entityManager->flush();

            return $this->redirectToRoute('registro_resumen', [
                'accidente' => $accidente->getId(),
            ]);
        }

        return $this->render('registro/peatones.html.twig', [
            'accidente' => $accidente,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{accidente}/accidente/resumen", name="registro_resumen", methods={"GET"})
     */
    public function resumen(Request $request, Accidente $accidente): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $accidente = $entityManager->getRepository(Accidente::class)->getResumen($accidente);
        return $this->render('registro/resumen.html.twig', [
            'accidente' => $accidente,
        ]);
    }

    /**
     * @Route("/{accidente}/accidente/confirmar", name="registro_confirmar", methods={"GET"})
     */
    public function confirmar(Request $request, Accidente $accidente): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $estadoConfirmado = $this->getDoctrine()->getRepository(EstadoAccidente::class)->findOneByNombre('Confirmado');
        $accidente->setEstadoAccidente($estadoConfirmado);
        $entityManager->persist($accidente);
        $entityManager->flush();
        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * @Route("/{accidente}", name="registro_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Accidente $accidente): Response
    {
        if ($this->isCsrfTokenValid('delete'.$accidente->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($accidente);
            $entityManager->flush();
        }

        return $this->redirectToRoute('registro_index');
    }

    /**
     * @Route("/busqueda/new", name="registro_busqueda_new", methods={"GET", "POST"})
     */
    public function busquedaNew(Request $request): Response
    {
        $user = $this->getUser();
        $funcionario = $user->getFuncionario();
        $unidad = $funcionario->getUnidad();

        $form = $this->createForm(AccidenteBusquedaType::class, null, ['unidad' => $unidad]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('session')->set('accidente_busqueda', $form->getData());
            return $this->redirectToRoute('registro_busqueda_index');
        }

        return $this->render('registro/busqueda.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/busqueda/index", name="registro_busqueda_index", methods={"GET"})
     */
    public function busquedaIndex(Request $request, PaginatorInterface $paginator): Response
    {
        $user = $this->getUser();
        $funcionario = $user->getFuncionario();
        $unidad = $funcionario->getUnidad();

        $busqueda = array();
        if($this->get('session')->has('accidente_busqueda')) {
            $busqueda = $this->get('session')->get('accidente_busqueda');
        }

        $query = $this->getDoctrine()->getRepository(Accidente::class)->findBusqueda($busqueda, $unidad);
        $sql = $query->getSQL();
        $page = 1;
        $limit = 10;
        $accidentes = $paginator->paginate($query, $request->query->getInt('page', $page), $limit);

        return $this->render('registro/index.html.twig', [
            'accidentes' => $accidentes,
            'busqueda' => $busqueda,
            'sql' => $sql,
        ]);
    }

    private function verificarPertinencia(Accidente $accidente)
    {
        if($accidente) {
            $user = $this->getUser();
            $funcionario = $user->getFuncionario();
            $unidad = $funcionario->getUnidad();
            if ($accidente->getUnidad() === $unidad) {
                return true;
            }
            if ($accidente->getFuncionarioResponsable() === $funcionario) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
