<?php

namespace App\Controller;

use App\Form\FiltroAccidenteVehiculoType;
use App\Form\ExportarAccidenteVehiculoType;

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
 * @Route("/inspeccion/accidenteVehiculo")
 */
class InspeccionAccidenteVehiculoController extends AbstractController
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
     * @Route("/filtrar", name="inspeccion_accidenteVehiculo_filtrar", methods={"GET", "POST"})
     */
    public function filtrar(Request $request): Response
    {
        $filtros = $this->get('session')->has('filtroAccidenteVehiculo') ? $this->get('session')->get('filtroAccidenteVehiculo') : null;

        $this->manageObjects($filtros);

        $form = $this->createForm(FiltroAccidenteVehiculoType::class, $filtros);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('session')->set('filtroAccidenteVehiculo', $form->getData());
            return $this->redirectToRoute('inspeccion_accidenteVehiculo_buscar');
        }

        return $this->render('inspeccion/accidenteVehiculo/filtrar.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/buscar", name="inspeccion_accidenteVehiculo_buscar", methods={"GET"})
     */
    public function buscar(Request $request, PaginatorInterface $paginator): Response
    {
        $busqueda = array();
        if($this->get('session')->has('filtroAccidenteVehiculo')) {
            $busqueda = $this->get('session')->get('filtroAccidenteVehiculo');
        }

        $query = $this->getDoctrine()->getRepository(Accidente::class)->filtroAccidenteVehiculo($busqueda);
        $parameters = $query->getParameters();
        $sql = $query->getSql();
        $page = 1;
        $limit = 100;
        $accidentes = $paginator->paginate($query, $request->query->getInt('page', $page), $limit);

        return $this->render('inspeccion/accidenteVehiculo/buscar.html.twig', [
            'accidentes' => $accidentes,
            'busqueda' => $busqueda,
            'sql' => $sql,
            'parameters' => $parameters,
        ]);
    }

    /**
     * @Route("/exportar", name="inspeccion_accidenteVehiculo_exportar", methods={"GET", "POST"})
     */
    public function exportar(Request $request, TranslatorInterface $translator): Response
    {
        $busqueda = array();
        if($this->get('session')->has('filtroAccidenteVehiculo')) {
            $busqueda = $this->get('session')->get('filtroAccidenteVehiculo');
        }

        $form = $this->createForm(ExportarAccidenteVehiculoType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $accidentes = $this->getDoctrine()->getRepository(Accidente::class)->filtroAccidenteVehiculo($busqueda)->getResult();

            $columnas = $form->getData();

            if($columnas['id']) $array[0][] = $translator->trans('accidente.id');
            if($columnas['fecha']) $array[0][] = $translator->trans('accidente.fecha');
            if($columnas['hora']) $array[0][] = $translator->trans('accidente.hora');

            if($columnas['cuadrante']) $array[0][] = $translator->trans('accidente.cuadrante');
            if($columnas['comuna']) $array[0][] = $translator->trans('accidente.comuna');
            if($columnas['provincia']) $array[0][] = $translator->trans('accidente.provincia');
            if($columnas['region']) $array[0][] = $translator->trans('accidente.region');

            if($columnas['cantidadPistasIda']) $array[0][] = $translator->trans('accidente.cantidad.cantidadPistasIda');
            if($columnas['cantidadPistasRegreso']) $array[0][] = $translator->trans('accidente.cantidad.cantidadPistasRegreso');
            if($columnas['vehiculosAccidente']) $array[0][] = $translator->trans('accidente.cantidad.vehiculosAccidente');
            if($columnas['pasajerosAccidente']) $array[0][] = $translator->trans('accidente.cantidad.pasajerosAccidente');
            if($columnas['peatonesAccidente']) $array[0][] = $translator->trans('accidente.cantidad.peatonesAccidente');
            if($columnas['personasAccidente']) $array[0][] = $translator->trans('accidente.cantidad.personasAccidente');
            if($columnas['fallecidosAccidente']) $array[0][] = $translator->trans('accidente.cantidad.fallecidosAccidente');
            if($columnas['gravesAccidente']) $array[0][] = $translator->trans('accidente.cantidad.gravesAccidente');
            if($columnas['menosGravesAccidente']) $array[0][] = $translator->trans('accidente.cantidad.menosGravesAccidente');
            if($columnas['levesAccidente']) $array[0][] = $translator->trans('accidente.cantidad.levesAccidente');
            if($columnas['ilesosAccidente']) $array[0][] = $translator->trans('accidente.cantidad.ilesosAccidente');
            if($columnas['seIgnoraAccidente']) $array[0][] = $translator->trans('accidente.cantidad.seIgnoraAccidente');

            if($columnas['glosa']) $array[0][] = $translator->trans('accidente.glosa');
            if($columnas['calle']) $array[0][] = $translator->trans('accidente.calle');
            if($columnas['numero']) $array[0][] = $translator->trans('accidente.numero');
            if($columnas['direccion']) $array[0][] = $translator->trans('accidente.direccion');
            if($columnas['latitud']) $array[0][] = $translator->trans('accidente.latitud');
            if($columnas['longitud']) $array[0][] = $translator->trans('accidente.longitud');

            if($columnas['claseAccidente']) $array[0][] = $translator->trans('accidente.claseAccidente');
            if($columnas['tipoAccidente']) $array[0][] = $translator->trans('accidente.tipoAccidente');
            if($columnas['causaBasal']) $array[0][] = $translator->trans('accidente.causaBasal');
            if($columnas['tipoCausa']) $array[0][] = $translator->trans('accidente.tipoCausa');

            $N = 1;
            foreach ($accidentes as $accidente) {

                if($columnas['id']) $array[$N][] = $accidente->getid();
                if($columnas['fecha']) $array[$N][] = $accidente->getfecha()->format('Y-m-d');
                if($columnas['hora']) $array[$N][] = $accidente->gethora()->format('H:i');

                if($columnas['cuadrante']) $array[$N][] = $accidente->getcuadrante() ? $accidente->getcuadrante()->getCodigoNombre() : '';
                if($columnas['comuna']) $array[$N][] = $accidente->getcomuna()->getCodigoNombre();
                if($columnas['provincia']) $array[$N][] = $accidente->getprovincia()->getCodigoNombre();
                if($columnas['region']) $array[$N][] = $accidente->getregion()->getCodigoNombre();

                if($columnas['cantidadPistasIda']) $array[$N][] = $accidente->getcantidadPistasIda();
                if($columnas['cantidadPistasRegreso']) $array[$N][] = $accidente->getcantidadPistasRegreso();
                if($columnas['vehiculosAccidente']) $array[$N][] = $accidente->getvehiculosAccidente()->count();
                if($columnas['pasajerosAccidente']) $array[$N][] = $accidente->getpasajerosAccidente()->count();
                if($columnas['peatonesAccidente']) $array[$N][] = $accidente->getpeatonesAccidente()->count();
                if($columnas['personasAccidente']) $array[$N][] = $accidente->getpersonasAccidente()->count();
                if($columnas['fallecidosAccidente']) $array[$N][] = $accidente->getfallecidosAccidente()->count();
                if($columnas['gravesAccidente']) $array[$N][] = $accidente->getgravesAccidente()->count();
                if($columnas['menosGravesAccidente']) $array[$N][] = $accidente->getmenosGravesAccidente()->count();
                if($columnas['levesAccidente']) $array[$N][] = $accidente->getlevesAccidente()->count();
                if($columnas['ilesosAccidente']) $array[$N][] = $accidente->getilesosAccidente()->count();
                if($columnas['seIgnoraAccidente']) $array[$N][] = $accidente->getseIgnoraAccidente()->count();

                if($columnas['glosa']) $array[$N][] = $accidente->getUbicacion()->getglosa();
                if($columnas['calle']) $array[$N][] = $accidente->getUbicacion()->getcalle();
                if($columnas['numero']) $array[$N][] = $accidente->getUbicacion()->getnumero();
                if($columnas['direccion']) $array[$N][] = $accidente->getUbicacion()->getdireccion();
                if($columnas['latitud']) $array[$N][] = $accidente->getUbicacion()->getlatitud();
                if($columnas['longitud']) $array[$N][] = $accidente->getUbicacion()->getlongitud();

                if($columnas['claseAccidente']) $array[$N][] = $accidente->getclaseAccidente()->getCodigoNombre();
                if($columnas['tipoAccidente']) $array[$N][] = $accidente->gettipoAccidente()->getCodigoNombre();
                if($columnas['causaBasal']) $array[$N][] = $accidente->getcausaBasal()->getCodigoNombre();
                if($columnas['tipoCausa']) $array[$N][] = $accidente->getTipoCausa()->getCodigoNombre();

                $N++;

            }

            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->fromArray($array, NULL, 'A1');

            $sheet->setTitle("Accidentes por vehículo");
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

        return $this->render('inspeccion/accidenteVehiculo/exportar.html.twig', [
            'busqueda' => $busqueda,
            'form' => $form->createView(),
        ]);
    }
}
