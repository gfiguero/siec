<?php

namespace App\Controller;

use App\Entity\Causa;
use App\Entity\Comuna;
use App\Entity\ClaseAccidente;
use App\Entity\TipoAccidente;
use App\Entity\Unidad;
use App\Entity\Funcionario;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Doctrine\Common\Collections\ArrayCollection;
use Freshcells\SoapClientBundle\SoapClient\SoapClient;

/**
 * @Route("/buscar")
 */
class BuscarController extends AbstractController
{
    /**
     * @Route("/comuna/{comuna}/unidades", name="buscar_comuna_unidades", methods={"GET"}, options={"expose" = true})
     * @ParamConverter("comuna", options={"mapping"={"comuna"="id"}})
     */
    public function unidadSearch(Comuna $comuna): JsonResponse
    {
        $unidades = new ArrayCollection();
        foreach ($comuna->getUnidades() as $unidad) {
            $unidades->add($unidad);
        }
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(0);
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $serializer = new Serializer([$normalizer], [new JsonEncoder()]);
        $unidades = $serializer->serialize($unidades, 'json', ['attributes' => ['id', 'codigoNombre']]);

        $response = JsonResponse::fromJsonString($unidades);
        return $response;
    }

    /**
     * @Route("/comuna/{comuna}/cuadrantes", name="buscar_comuna_cuadrantes", methods={"GET"}, options={"expose" = true})
     * @ParamConverter("comuna", options={"mapping"={"comuna"="id"}})
     */
    public function cuadranteSearch(Comuna $comuna): JsonResponse
    {
        $cuadrantes = new ArrayCollection();
        foreach ($comuna->getCuadrantes() as $cuadrante) {
            $cuadrantes->add($cuadrante);
        }
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(0);
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $serializer = new Serializer([$normalizer], [new JsonEncoder()]);
        $cuadrantes = $serializer->serialize($cuadrantes, 'json', ['attributes' => ['id', 'codigoNombre']]);

        $response = JsonResponse::fromJsonString($cuadrantes);
        return $response;
    }

    /**
     * @Route("/claseAccidente/{claseAccidente}/tiposUbicacionRelativaAccidente", name="buscar_claseAccidente_tiposUbicacionRelativaAccidente", methods={"GET"}, options={"expose" = true})
     * @ParamConverter("claseAccidente", options={"mapping"={"claseAccidente"="id"}})
     */
    public function tipoUbicacionRelativaAccidenteSearch(ClaseAccidente $claseAccidente): JsonResponse
    {
        $tiposUbicacionRelativaAccidente = new ArrayCollection();
        foreach ($claseAccidente->getTiposUbicacionRelativaAccidente() as $tipoUbicacionRelativaAccidente) {
            $tiposUbicacionRelativaAccidente->add($tipoUbicacionRelativaAccidente);
        }
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(0);
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $serializer = new Serializer([$normalizer], [new JsonEncoder()]);
        $tiposUbicacionRelativaAccidente = $serializer->serialize($tiposUbicacionRelativaAccidente, 'json', ['attributes' => ['id', 'codigoNombre']]);

        $response = JsonResponse::fromJsonString($tiposUbicacionRelativaAccidente);
        return $response;
    }

    /**
     * @Route("/claseAccidente/{claseAccidente}/tiposAccidente", name="buscar_claseAccidente_tiposAccidente", methods={"GET"}, options={"expose" = true})
     * @ParamConverter("claseAccidente", options={"mapping"={"claseAccidente"="id"}})
     */
    public function tipoAccidenteSearch(ClaseAccidente $claseAccidente): JsonResponse
    {
//        $entityManager = $this->getDoctrine()->getManager();
//        $tiposAccidente = $entityManager->getRepository(TipoAccidente::class)->findBy(array('claseAccidente' => $claseAccidente), array('codigo' => 'ASC'));

        $tiposAccidente = new ArrayCollection();
        foreach ($claseAccidente->getTiposAccidente() as $tipoAccidente) {
            $tiposAccidente->add($tipoAccidente);
        }
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(0);
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $serializer = new Serializer([$normalizer], [new JsonEncoder()]);
        $tiposAccidente = $serializer->serialize($tiposAccidente, 'json', ['attributes' => ['id', 'codigoNombre']]);

        $response = JsonResponse::fromJsonString($tiposAccidente);
        return $response;
    }

    /**
     * @Route("/unidad/{unidad}/funcionarios", name="buscar_unidad_funcionarios", methods={"GET"}, options={"expose" = true})
     * @ParamConverter("unidad", options={"mapping"={"unidad"="id"}})
     */
    public function funcionarioSearch(Unidad $unidad): JsonResponse
    {
        $funcionarios = new ArrayCollection();
        foreach ($unidad->getFuncionarios() as $funcionario) {
            $funcionarios->add($funcionario);
        }
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(0);
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $serializer = new Serializer([$normalizer], [new JsonEncoder()]);
        $funcionarios = $serializer->serialize($funcionarios, 'json', ['attributes' => ['id', 'codigoNombre']]);

        $response = JsonResponse::fromJsonString($funcionarios);
        return $response;
    }

    /**
     * @Route("/causa/{causa}/causasConcurrentes", name="buscar_causaBasal_causasConcurrentes", methods={"GET"}, options={"expose" = true})
     * @ParamConverter("causa", options={"mapping"={"causa"="id"}})
     */
    public function causasConcurrentesSearch(Causa $causa): JsonResponse
    {
        $entityManager = $this->getDoctrine()->getManager();
        $causas = $entityManager->getRepository(Causa::class)->findCausasConcurrentes($causa);

        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(0);
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $serializer = new Serializer([$normalizer], [new JsonEncoder()]);
        $causas = $serializer->serialize($causas, 'json', ['attributes' => ['id', 'codigoNombre']]);

        $response = JsonResponse::fromJsonString($causas);
        return $response;
    }

    /**
     * @Route("/textoLibre/{textoLibre}/busquedaMaestroCalles", name="buscar_maestro_calles", methods={"GET"}, options={"expose" = true})
     */
    public function buscarMaestro(Request $request, $textoLibre): JsonResponse
    {
        $soapClient = new SoapClient('http://sait.carabineros.cl/Ws_OS2/?wsdl');
        $tipo = $soapClient->getTipo(['busqueda' => $textoLibre]);
        $response = $soapClient->FindDireccionesTextLibre([
            'busqueda' => $textoLibre,
            'tipo' => $tipo->GetTipoResult,
            'pais' => 'CHILE',
            'cantResultados' => 10,
        ]);
        if(property_exists($response->FindDireccionesTextLibreResult, 'DireccionTextLibre')) {
            return new JsonResponse($response->FindDireccionesTextLibreResult->DireccionTextLibre);
        } else {
            return new JsonResponse();
        }
    }

    /**
     * @Route("/assets/marker", name="buscar_marker", methods={"GET"}, options={"expose" = true})
     */
    public function buscarMarker(): BinaryFileResponse
    {
        return new BinaryFileResponse($this->getParameter('kernel.project_dir') . '/public/img/marker.png');
    }
}
