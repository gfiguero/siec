<?php

namespace App\Controller;

use App\Entity\Accidente;
use App\Entity\Vehiculo;
use App\Entity\VehiculoAccidente;
use App\Entity\PersonaAccidente;
use App\Entity\Causa;
use App\Entity\Comuna;
use App\Entity\ClaseAccidente;
use App\Entity\TipoAccidente;
use App\Entity\Unidad;
use App\Entity\Funcionario;
use App\Entity\RegistroEtapa;
use App\Entity\EstadoAccidente;

use App\Form\AccidenteType;
use App\Form\MensajeType;
use App\Form\InspeccionVehiculoAccidenteType;
use App\Form\ConductorAccidenteType;
use App\Form\PasajeroAccidenteType;
use App\Form\PeatonAccidenteType;

use App\Form\FiltroAccidenteUnidadType;
use App\Form\ExportarAccidenteUnidadType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Doctrine\Common\Collections\ArrayCollection;
use Freshcells\SoapClientBundle\SoapClient\SoapClient;
use Knp\Component\Pager\PaginatorInterface;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/**
 * @Route("/inspeccion/accidenteUnidad")
 */
class InspeccionAccidenteUnidadController extends AbstractController
{

    public function manageObjects($data_array = null)
    {
        $em = $this->getDoctrine()->getEntityManager();

        if ($data_array) {
            foreach ($data_array as $key => $value) {
                if ($value instanceof ArrayCollection) {
                    $data_array[$key] = $this->manageObjects($value);
                }
                elseif ($value instanceof \DateTime) {

                } 
                elseif (is_object($value)) {
                    $data_array[$key] = $em->merge($value);
                }
            }
        }
        return $data_array;
    }

    /**
     * @Route("/filtrar", name="inspeccion_accidenteUnidad_filtrar", methods={"GET", "POST"})
     */
    public function filtrar(Request $request): Response
    {
        $filtros = $this->get('session')->has('filtroAccidenteUnidad') ? $this->get('session')->get('filtroAccidenteUnidad') : null;

        $this->manageObjects($filtros);

        $form = $this->createForm(FiltroAccidenteUnidadType::class, $filtros);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('session')->set('filtroAccidenteUnidad', $form->getData());
            return $this->redirectToRoute('inspeccion_accidenteUnidad_buscar');
        }

        return $this->render('inspeccion/accidenteUnidad/filtrar.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/buscar", name="inspeccion_accidenteUnidad_buscar", methods={"GET"})
     */
    public function buscar(Request $request, PaginatorInterface $paginator): Response
    {
        $busqueda = array();
        if($this->get('session')->has('filtroAccidenteUnidad')) {
            $busqueda = $this->get('session')->get('filtroAccidenteUnidad');
        }

        $query = $this->getDoctrine()->getRepository(Accidente::class)->filtroAccidenteUnidad($busqueda);
        $parameters = $query->getParameters();
        $sql = $query->getSql();
        $page = 1;
        $limit = 100;
        $accidentes = $paginator->paginate($query, $request->query->getInt('page', $page), $limit);

        return $this->render('inspeccion/accidenteUnidad/buscar.html.twig', [
            'accidentes' => $accidentes,
            'busqueda' => $busqueda,
            'sql' => $sql,
            'parameters' => $parameters,
        ]);
    }

    /**
     * @Route("/exportar", name="inspeccion_accidenteUnidad_exportar", methods={"GET", "POST"})
     */
    public function exportar(Request $request, TranslatorInterface $translator): Response
    {
        $busqueda = array();
        if($this->get('session')->has('filtroAccidenteUnidad')) {
            $busqueda = $this->get('session')->get('filtroAccidenteUnidad');
        }

        $form = $this->createForm(ExportarAccidenteUnidadType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $accidentes = $this->getDoctrine()->getRepository(Accidente::class)->filtroAccidenteUnidad($busqueda)->getResult();

            $columnas = $form->getData();

            if($columnas['id']) $array[0][] = $translator->trans('accidente.id');
            if($columnas['fecha']) $array[0][] = $translator->trans('accidente.fecha');
            if($columnas['hora']) $array[0][] = $translator->trans('accidente.hora');

            if($columnas['cuadrante']) $array[0][] = $translator->trans('accidente.cuadrante');
            if($columnas['comuna']) $array[0][] = $translator->trans('accidente.comuna');
            if($columnas['provincia']) $array[0][] = $translator->trans('accidente.provincia');
            if($columnas['region']) $array[0][] = $translator->trans('accidente.region');

            if($columnas['glosa']) $array[0][] = $translator->trans('accidente.glosa');
            if($columnas['calle']) $array[0][] = $translator->trans('accidente.calle');
            if($columnas['numero']) $array[0][] = $translator->trans('accidente.numero');
            if($columnas['direccion']) $array[0][] = $translator->trans('accidente.direccion');
            if($columnas['latitud']) $array[0][] = $translator->trans('accidente.latitud');
            if($columnas['longitud']) $array[0][] = $translator->trans('accidente.longitud');

            if($columnas['unidad']) $array[0][] = $translator->trans('accidente.unidad');
            if($columnas['funcionario']) $array[0][] = $translator->trans('accidente.funcionario');
            if($columnas['numeroParte']) $array[0][] = $translator->trans('accidente.numeroParte');
            if($columnas['numeroFormulario']) $array[0][] = $translator->trans('accidente.numeroFormulario');
            if($columnas['esMensaje']) $array[0][] = $translator->trans('accidente.esMensaje');
            if($columnas['concurreSiat']) $array[0][] = $translator->trans('accidente.concurreSiat');
            if($columnas['estadoAccidente']) $array[0][] = $translator->trans('accidente.estadoAccidente');

            $N = 1;
            foreach ($accidentes as $accidente) {

                if($columnas['id']) $array[$N][] = $accidente->getid();
                if($columnas['fecha']) $array[$N][] = $accidente->getfecha()->format('Y-m-d');
                if($columnas['hora']) $array[$N][] = $accidente->gethora()->format('H:i');

                if($columnas['cuadrante']) $array[$N][] = $accidente->getcuadrante() ? $accidente->getcuadrante()->getCodigoNombre() : '';
                if($columnas['comuna']) $array[$N][] = $accidente->getcomuna()->getCodigoNombre();
                if($columnas['provincia']) $array[$N][] = $accidente->getprovincia()->getCodigoNombre();
                if($columnas['region']) $array[$N][] = $accidente->getregion()->getCodigoNombre();

                if($columnas['glosa']) $array[$N][] = $accidente->getUbicacion()->getglosa();
                if($columnas['calle']) $array[$N][] = $accidente->getUbicacion()->getcalle();
                if($columnas['numero']) $array[$N][] = $accidente->getUbicacion()->getnumero();
                if($columnas['direccion']) $array[$N][] = $accidente->getUbicacion()->getdireccion();
                if($columnas['latitud']) $array[$N][] = $accidente->getUbicacion()->getlatitud();
                if($columnas['longitud']) $array[$N][] = $accidente->getUbicacion()->getlongitud();

                if($columnas['unidad']) $array[$N][] = $accidente->getunidad();
                if($columnas['funcionario']) $array[$N][] = $accidente->getfuncionario();
                if($columnas['numeroParte']) $array[$N][] = $accidente->getnumeroParte();
                if($columnas['numeroFormulario']) $array[$N][] = $accidente->getnumeroFormulario();
                if($columnas['esMensaje']) $array[$N][] = $accidente->getesMensaje() ? 'Si' : 'No';
                if($columnas['concurreSiat']) $array[$N][] = $accidente->getconcurreSiat() ? 'Si' : 'No';
                if($columnas['estadoAccidente']) $array[$N][] = $accidente->getestadoAccidente();

                $N++;

            }

            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->fromArray($array, NULL, 'A1');

            $sheet->setTitle("Accidentes por unidad");
            $writer = new Xlsx($spreadsheet);
            $publicDirectory = $this->getParameter('kernel.project_dir') . '/public';
            $excelFilepath =  $publicDirectory . '/my_first_excel_symfony4.xlsx';
            $writer->save($excelFilepath);

            $datetime = new \DateTime();
            $datestring = $datetime->format("Y_m_d_H_i");
            $filename = 'SIEC_Accidentes_' . $datestring . '.xlsx';

            $response = new BinaryFileResponse($excelFilepath);
            $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, $filename );
            return $response;
        }

        return $this->render('inspeccion/accidenteUnidad/exportar.html.twig', [
            'busqueda' => $busqueda,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{accidente}/accidente/resumen", name="inspeccion_accidenteUnidad_resumen", methods={"GET"})
     */
    public function resumen(Request $request, Accidente $accidente): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $accidente = $entityManager->getRepository(Accidente::class)->getResumen($accidente);
        return $this->render('inspeccion/accidenteUnidad/resumen.html.twig', [
            'accidente' => $accidente,
        ]);
    }

    /**
     * @Route("/{accidente}/accidente/objetar", name="inspeccion_accidenteUnidad_objetar", methods={"GET"})
     */
    public function objetar(Request $request, Accidente $accidente): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $accidente->setEstadoAccidente($this->getDoctrine()->getRepository(EstadoAccidente::class)->findOneByNombre('Objetado'));
        $entityManager->persist($accidente);
        $entityManager->flush();
        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * @Route("/{accidente}/accidente/mensaje", name="inspeccion_accidenteUnidad_mensaje", methods={"GET", "POST"})
     */
    public function mensaje(Request $request, Accidente $accidente): Response
    {
        $form = $this->createForm(MensajeType::class, $accidente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $accidente->setEstadoAccidente($this->getDoctrine()->getRepository(EstadoAccidente::class)->findOneByNombre('Objetado'));
            $accidente->setEsMensaje(true);
            $accidente->comprobarIncoherencia();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($accidente);
            $entityManager->flush();

            return $this->redirectToRoute('inspeccion_accidenteUnidad_buscar');
        }

        return $this->render('inspeccion/accidenteUnidad/mensaje.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{accidente}/accidente/editar", name="inspeccion_accidenteUnidad_editar", methods={"GET", "POST"})
     */
    public function editar(Request $request, Accidente $accidente): Response
    {
        $form = $this->createForm(AccidenteType::class, $accidente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($accidente);
            $entityManager->flush();
            return $this->redirectToRoute('inspeccion_accidenteUnidad_buscar');
        }

        return $this->render('inspeccion/accidenteUnidad/editar.html.twig', [
            'accidente' => $accidente,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{vehiculoAccidente}/vehiculoAccidente/editar", name="inspeccion_accidenteUnidad_editarVehiculo", methods={"GET", "POST"})
     */
    public function editarVehiculo(Request $request, VehiculoAccidente $vehiculoAccidente): Response
    {
        $form = $this->createForm(InspeccionVehiculoAccidenteType::class, $vehiculoAccidente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($vehiculoAccidente);
            $entityManager->flush();
            return $this->redirectToRoute('inspeccion_accidente_editar', ['accidente' => $vehiculoAccidente->getAccidente()]);
        }

        return $this->render('inspeccion/accidenteUnidad/editarVehiculo.html.twig', [
            'vehiculoAccidente' => $vehiculoAccidente,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{conductorAccidente}/conductorAccidente/editar", name="inspeccion_accidenteUnidad_editarConductor", methods={"GET", "POST"})
     */
    public function editarConductor(Request $request, PersonaAccidente $conductorAccidente): Response
    {
        $form = $this->createForm(ConductorAccidenteType::class, $conductorAccidente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($conductorAccidente);
            $entityManager->flush();
            return $this->redirectToRoute('inspeccion_accidente_editar', ['accidente' => $conductorAccidente->getVehiculoConducidoAccidente()->getAccidente()]);
        }

        return $this->render('inspeccion/accidenteUnidad/editarConductor.html.twig', [
            'conductorAccidente' => $conductorAccidente,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{pasajeroAccidente}/pasajeroAccidente/editar", name="inspeccion_accidenteUnidad_editarPasajero", methods={"GET", "POST"})
     */
    public function editarPasajero(Request $request, PersonaAccidente $pasajeroAccidente): Response
    {
        $form = $this->createForm(PasajeroAccidenteType::class, $pasajeroAccidente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pasajeroAccidente);
            $entityManager->flush();
            return $this->redirectToRoute('inspeccion_accidente_editar', ['accidente' => $pasajeroAccidente->getVehiculoAccidente()->getAccidente()]);
        }

        return $this->render('inspeccion/accidenteUnidad/editarPasajero.html.twig', [
            'pasajeroAccidente' => $pasajeroAccidente,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{peatonAccidente}/peatonAccidente/editar", name="inspeccion_accidenteUnidad_editarPeaton", methods={"GET", "POST"})
     */
    public function editarPeaton(Request $request, PersonaAccidente $peatonAccidente): Response
    {
        $form = $this->createForm(PeatonAccidenteType::class, $peatonAccidente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($peatonAccidente);
            $entityManager->flush();
            return $this->redirectToRoute('inspeccion_accidente_editar', ['accidente' => $peatonAccidente->getAccidente()]);
        }

        return $this->render('inspeccion/accidenteUnidad/editarPeaton.html.twig', [
            'peatonAccidente' => $peatonAccidente,
            'form' => $form->createView(),
        ]);
    }
}
