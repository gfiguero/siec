<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Freshcells\SoapClientBundle\SoapClient\SoapClient;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\TipoAccidente;
use App\Entity\Accidente;
use App\Entity\Incoherencia;
use App\Entity\Comuna;
use App\Entity\Persona;
use App\Entity\Unidad;
use App\Form\PersonaType;

use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Knp\Snappy\Pdf;

/**
 * @Route("/test")
 */
class TestController extends AbstractController
{
    /**
     * @Route("/soap", name="test_soap", methods={"GET"})
     */
    public function soap(Request $request): Response
    {
//        $glosa = 'RUTA 68 KM 45';
//        $soapClient = new SoapClient('http://sait.carabineros.cl/Ws_OS2/?wsdl');
//        $tipo = $soapClient->getTipo(['busqueda' => $glosa]);
//        $response = $soapClient->FindDireccionesTextLibre(['busqueda' => $glosa,'tipo' => $tipo->GetTipoResult,'pais' => 'CHILE','cantResultados' => '10']);
//        dump($response);
        $form = $this->createFormBuilder()
            ->add('Glosa', TextType::class)
            ->add('Buscar', ButtonType::class)
            ->getForm();

        return $this->render('test/soap.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/buscarMaestro/{glosa}", name="buscar_maestro", methods={"GET"}, options={"expose" = true})
     */
    public function buscarMaestro(Request $request, $glosa): Response
    {
        $soapClient = new SoapClient('http://sait.carabineros.cl/Ws_OS2/?wsdl');
        $tipo = $soapClient->getTipo(['busqueda' => $glosa]);
        $response = $soapClient->FindDireccionesTextLibre(['busqueda' => $glosa,'tipo' => $tipo->GetTipoResult,'pais' => 'CHILE','cantResultados' => 10]);
        return new JsonResponse($response->FindDireccionesTextLibreResult->DireccionTextLibre);
    }

    /**
     * @Route("/{id}/persona", name="test_persona", methods={"GET","POST"})
     */
    public function testPersona(Request $request, Persona $persona): Response
    {
        $form = $this->createForm(PersonaType::class, $persona);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($persona);
            $entityManager->flush();
        }

        return $this->render('test/persona.html.twig', [
            'persona' => $persona,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/exportacion", name="test_exportacion", methods={"GET"})
     */
    public function testExportacion(Request $request): Response
    {
        $list = $this->getDoctrine()->getRepository(Comuna::class)->findAll();

        return $this->render('test/exportacion.html.twig', [
            'list' => $list,
        ]);
    }

    /**
     * @Route("/numeroformulario/{unidad}/unidad", name="test_numero_formulario", methods={"GET"})
     */
    public function testNumeroFormulario(Request $request, Unidad $unidad): Response
    {
        $numeroformulario = $this->getDoctrine()->getRepository(Accidente::class)->obtenerNumeroFormulario($unidad);
        dump($unidad);
        dump($numeroformulario);
        return new JsonResponse($numeroformulario);
    }

    /**
     * @Route("/incoherencias/{accidente}/accidente", name="incoherencias_accidente", methods={"GET"})
     */
    public function comprobarIncoherencias(Request $request, Accidente $accidente): Response
    {
        $accidente->comprobarIncoherencia();
        return $this->render('test/incoherencias.html.twig', [
            'accidente' => $accidente,
        ]);
    }

    /**
     * @Route("/accidente/{accidente}/comprobarEtapas", name="accidente_comprobarEtapas", methods={"GET"})
     */
    public function comprobarEtapas(Request $request, Accidente $accidente): Response
    {
        return $this->render('test/etapas.html.twig', [
            'registroEtapas' => $accidente->getRegistroEtapas(),
        ]);
    }

    /**
     * @Route("/accidentes/exportar", name="accidente_exportar", methods={"GET"})
     */
    public function exportarAccidentes(Request $request): Response
    {
        $accidentes = $this->getDoctrine()->getRepository(Accidente::class)->findAll();
        return $this->render('test/exportar.html.twig', [
            'accidentes' => $accidentes,
        ]);
    }

    /**
     * @Route("/{accidente}/accidente/pdf", name="accidente_pdf", methods={"GET"})
     */
    public function accidentePdf(Request $request, Pdf $snappy, Accidente $accidente): Response
    {
        $html = $this->render('test/accidente_html.html.twig', [
            'accidente' => $accidente,
        ]);

        $pdf = $snappy->getOutputFromHtml($html);

        return new PdfResponse($pdf, 'file.pdf');
    }

    /**
     * @Route("/{accidente}/accidente/html", name="accidente_html", methods={"GET"})
     */
    public function accidenteHtml(Request $request, Accidente $accidente): Response
    {
        return $this->render('test/accidente_html.html.twig', [
            'accidente' => $accidente,
        ]);
    }

    /**
     * @Route("/accidente/repository", name="test_accidente_repository", methods={"GET"})
     */
    public function accidenteRepository(Request $request): Response
    {
        $accidentes = $this->getDoctrine()->getRepository(Accidente::class)->filtroAccidenteVehiculo()->getResult();

        return $this->render('test/accidentes.html.twig', [
            'accidentes' => $accidentes,
        ]);
    }

}
