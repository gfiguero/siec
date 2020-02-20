<?php

namespace App\Repository;

use App\Entity\VehiculoAccidente;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method VehiculoAccidente|null find($id, $lockMode = null, $lockVersion = null)
 * @method VehiculoAccidente|null findOneBy(array $criteria, array $orderBy = null)
 * @method VehiculoAccidente[]    findAll()
 * @method VehiculoAccidente[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VehiculoAccidenteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VehiculoAccidente::class);
    }

    public function findInspeccion($busqueda)
    {
        $qb = $this->createQueryBuilder('v');

        $qb->select('v');

        $qb->addSelect('a');
        $qb->leftJoin('v.accidente', 'a');

        if(array_key_exists('idMin', $busqueda) and $busqueda['idMin']) {
            $qb->andWhere('a.id >= :idMin');
            $qb->setParameter('idMin', $busqueda['idMin']);
        }

        if(array_key_exists('idMax', $busqueda) and $busqueda['idMax']) {
            $qb->andWhere('a.id <= :idMax');
            $qb->setParameter('idMax', $busqueda['idMax']);
        }

        if(array_key_exists('fechaMin', $busqueda) and $busqueda['fechaMin']) {
            $qb->andWhere('a.fecha >= DATE(:fechaMin)');
            $qb->setParameter('fechaMin', $busqueda['fechaMin']);
        }

        if(array_key_exists('fechaMax', $busqueda) and $busqueda['fechaMax']) {
            $qb->andWhere('a.fecha <= DATE(:fechaMax)');
            $qb->setParameter('fechaMax', $busqueda['fechaMax']);
        }

        if(array_key_exists('horaMin', $busqueda) and $busqueda['horaMin']) {
            $qb->andWhere('a.hora >= TIME(:horaMin)');
            $qb->setParameter('horaMin', $busqueda['horaMin']);
        }

        if(array_key_exists('horaMax', $busqueda) and $busqueda['horaMax']) {
            $qb->andWhere('a.hora <= TIME(:horaMax)');
            $qb->setParameter('horaMax', $busqueda['horaMax']);
        }

// Institucional
        if(array_key_exists('unidad', $busqueda) and !$busqueda['unidad']->isEmpty()) {
            $qb->addSelect('u');
            $qb->leftJoin('a.unidad', 'u');
            $qb->andWhere('a.unidad in (:unidad)');
            $qb->setParameter('unidad', $busqueda['unidad']);
        }

        if(array_key_exists('funcionario', $busqueda) and !$busqueda['funcionario']->isEmpty()) {
            $qb->addSelect('f');
            $qb->leftJoin('a.funcionario', 'f');
            $qb->andWhere('a.funcionario in (:funcionario)');
            $qb->setParameter('funcionario', $busqueda['funcionario']);
        }

        if(array_key_exists('tribunal', $busqueda) and !$busqueda['tribunal']->isEmpty()) {
            $qb->addSelect('t');
            $qb->leftJoin('a.tribunal', 't');
            $qb->andWhere('a.tribunal in (:tribunal)');
            $qb->setParameter('tribunal', $busqueda['tribunal']);
        }

        if(array_key_exists('numeroParte', $busqueda) and $busqueda['numeroParte']) {
            $qb->andWhere('a.numeroParte = :numeroParte');
            $qb->setParameter('numeroParte', $busqueda['numeroParte']);
        }

        if(array_key_exists('numeroFormulario', $busqueda) and $busqueda['numeroFormulario']) {
            $qb->andWhere('a.numeroFormulario = :numeroFormulario');
            $qb->setParameter('numeroFormulario', $busqueda['numeroFormulario']);
        }

        if(array_key_exists('esMensaje', $busqueda) and $busqueda['esMensaje']) {
            $qb->andWhere('a.esMensaje = TRUE');
        }

        if(array_key_exists('concurreSiat', $busqueda) and $busqueda['concurreSiat']) {
            $qb->andWhere('a.concurreSiat = TRUE');
        }

// Espacial
        $qb->addSelect('c');
        $qb->addSelect('p');
        $qb->addSelect('r');
        $qb->leftJoin('a.comuna', 'c');
        $qb->leftJoin('c.provincia', 'p');
        $qb->leftJoin('p.region', 'r');


        if(array_key_exists('region', $busqueda) and !$busqueda['region']->isEmpty()) {
            $qb->andWhere('p.region in (:region)');
            $qb->setParameter('region', $busqueda['region']);
        }

        if(array_key_exists('provincia', $busqueda) and !$busqueda['provincia']->isEmpty()) {
            $qb->andWhere('c.provincia in (:provincia)');
            $qb->setParameter('provincia', $busqueda['provincia']);
        }

        if(array_key_exists('comuna', $busqueda) and !$busqueda['comuna']->isEmpty()) {
            $qb->andWhere('a.comuna in (:comuna)');
            $qb->setParameter('comuna', $busqueda['comuna']);
        }

        if(array_key_exists('cuadrante', $busqueda) and !$busqueda['cuadrante']->isEmpty()) {
            $qb->addSelect('cu');
            $qb->leftJoin('a.cuadrante', 'cu');
            $qb->andWhere('a.cuadrante in (:cuadrante)');
            $qb->setParameter('cuadrante', $busqueda['cuadrante']);
        }

        if(array_key_exists('tipoDireccion', $busqueda) and !$busqueda['tipoDireccion']->isEmpty()) {
            $qb->addSelect('td');
            $qb->leftJoin('a.tipoDireccion', 'td');
            $qb->andWhere('a.tipoDireccion in (:tipoDireccion)');
            $qb->setParameter('tipoDireccion', $busqueda['tipoDireccion']);
        }

        if(array_key_exists('tipoUbicacionRelativaAccidente', $busqueda) and !$busqueda['tipoUbicacionRelativaAccidente']->isEmpty()) {
            $qb->addSelect('tur');
            $qb->leftJoin('a.tipoUbicacionRelativaAccidente', 'tur');
            $qb->andWhere('a.tipoUbicacionRelativaAccidente in (:tipoUbicacionRelativaAccidente)');
            $qb->setParameter('tipoUbicacionRelativaAccidente', $busqueda['tipoUbicacionRelativaAccidente']);
        }

        if(array_key_exists('tipoZonaAccidente', $busqueda) and !$busqueda['tipoZonaAccidente']->isEmpty()) {
            $qb->addSelect('tz');
            $qb->leftJoin('a.tipoZonaAccidente', 'tz');
            $qb->andWhere('a.tipoZonaAccidente in (:tipoZonaAccidente)');
            $qb->setParameter('tipoZonaAccidente', $busqueda['tipoZonaAccidente']);
        }

// Cualitativa

        $qb->addSelect('i');
        $qb->addSelect('re');
        $qb->leftJoin('a.incoherencias', 'i');
        $qb->leftJoin('a.registroEtapas', 're');

        if(array_key_exists('estadoAccidente', $busqueda) and !$busqueda['estadoAccidente']->isEmpty()) {
            $qb->addSelect('ea');
            $qb->leftJoin('a.estadoAccidente', 'ea');
            $qb->andWhere('a.estadoAccidente in (:estadoAccidente)');
            $qb->setParameter('estadoAccidente', $busqueda['estadoAccidente']);
        }

        if(array_key_exists('claseAccidente', $busqueda) and !$busqueda['claseAccidente']->isEmpty()) {
            $qb->addSelect('ca');
            $qb->leftJoin('a.claseAccidente', 'ca');
            $qb->andWhere('a.claseAccidente in (:claseAccidente)');
            $qb->setParameter('claseAccidente', $busqueda['claseAccidente']);
        }

        if(array_key_exists('tipoAccidente', $busqueda) and !$busqueda['tipoAccidente']->isEmpty()) {
            $qb->addSelect('ta');
            $qb->leftJoin('a.tipoAccidente', 'ta');
            $qb->andWhere('a.tipoAccidente in (:tipoAccidente)');
            $qb->setParameter('tipoAccidente', $busqueda['tipoAccidente']);
        }

        $qb->addSelect('cb');
        $qb->addSelect('tc');
        $qb->leftJoin('a.causaBasal', 'cb');
        $qb->leftJoin('cb.tipoCausa', 'tc');

        if(array_key_exists('tipoCausa', $busqueda) and !$busqueda['tipoCausa']->isEmpty()) {
            $qb->andWhere('cb.tipoCausa in (:tipoCausa)');
            $qb->setParameter('tipoCausa', $busqueda['tipoCausa']);
        }

        if(array_key_exists('causaBasal', $busqueda) and !$busqueda['causaBasal']->isEmpty()) {
            $qb->andWhere('a.causaBasal in (:causaBasal)');
            $qb->setParameter('causaBasal', $busqueda['causaBasal']);
        }

        if(array_key_exists('estadoAtmosferico', $busqueda) and !$busqueda['estadoAtmosferico']->isEmpty()) {
            $qb->addSelect('eat');
            $qb->leftJoin('a.estadoAtmosferico', 'eat');
            $qb->andWhere('a.estadoAtmosferico in (:estadoAtmosferico)');
            $qb->setParameter('estadoAtmosferico', $busqueda['estadoAtmosferico']);
        }

        if(array_key_exists('tipoLuminosidad', $busqueda) and !$busqueda['tipoLuminosidad']->isEmpty()) {
            $qb->addSelect('tl');
            $qb->leftJoin('a.tipoLuminosidad', 'tl');
            $qb->andWhere('a.tipoLuminosidad in (:tipoLuminosidad)');
            $qb->setParameter('tipoLuminosidad', $busqueda['tipoLuminosidad']);
        }

        if(array_key_exists('estadoLuzArtificial', $busqueda) and !$busqueda['estadoLuzArtificial']->isEmpty()) {
            $qb->addSelect('el');
            $qb->leftJoin('a.estadoLuzArtificial', 'el');
            $qb->andWhere('a.estadoLuzArtificial in (:estadoLuzArtificial)');
            $qb->setParameter('estadoLuzArtificial', $busqueda['estadoLuzArtificial']);
        }

        if(array_key_exists('tipoPavimentoCalzada', $busqueda) and !$busqueda['tipoPavimentoCalzada']->isEmpty()) {
            $qb->addSelect('tp');
            $qb->leftJoin('a.tipoPavimentoCalzada', 'tp');
            $qb->andWhere('a.tipoPavimentoCalzada in (:tipoPavimentoCalzada)');
            $qb->setParameter('tipoPavimentoCalzada', $busqueda['tipoPavimentoCalzada']);
        }

        if(array_key_exists('condicionPavimentoCalzada', $busqueda) and !$busqueda['condicionPavimentoCalzada']->isEmpty()) {
            $qb->addSelect('cp');
            $qb->leftJoin('a.condicionPavimentoCalzada', 'cp');
            $qb->andWhere('a.condicionPavimentoCalzada in (:condicionPavimentoCalzada)');
            $qb->setParameter('condicionPavimentoCalzada', $busqueda['condicionPavimentoCalzada']);
        }

        if(array_key_exists('estadoPavimentoCalzada', $busqueda) and !$busqueda['estadoPavimentoCalzada']->isEmpty()) {
            $qb->addSelect('ep');
            $qb->leftJoin('a.estadoPavimentoCalzada', 'ep');
            $qb->andWhere('a.estadoPavimentoCalzada in (:estadoPavimentoCalzada)');
            $qb->setParameter('estadoPavimentoCalzada', $busqueda['estadoPavimentoCalzada']);
        }

        if(array_key_exists('tipoCalzada', $busqueda) and !$busqueda['tipoCalzada']->isEmpty()) {
            $qb->addSelect('tca');
            $qb->leftJoin('a.tipoCalzada', 'tca');
            $qb->andWhere('a.tipoCalzada in (:tipoCalzada)');
            $qb->setParameter('tipoCalzada', $busqueda['tipoCalzada']);
        }

        if(array_key_exists('demarcacionLineaCalzada', $busqueda) and !$busqueda['demarcacionLineaCalzada']->isEmpty()) {
            $qb->addSelect('dl');
            $qb->leftJoin('a.demarcacionLineaCalzada', 'dl');
            $qb->andWhere('a.demarcacionLineaCalzada in (:demarcacionLineaCalzada)');
            $qb->setParameter('demarcacionLineaCalzada', $busqueda['demarcacionLineaCalzada']);
        }

        if(array_key_exists('demarcacionPrioridadCalzada', $busqueda) and !$busqueda['demarcacionPrioridadCalzada']->isEmpty()) {
            $qb->addSelect('dp');
            $qb->leftJoin('a.demarcacionPrioridadCalzada', 'dp');
            $qb->andWhere('a.demarcacionPrioridadCalzada in (:demarcacionPrioridadCalzada)');
            $qb->setParameter('demarcacionPrioridadCalzada', $busqueda['demarcacionPrioridadCalzada']);
        }

        if(array_key_exists('elementoCalzada', $busqueda) and !$busqueda['elementoCalzada']->isEmpty()) {
            $qb->addSelect('ec');
            $qb->leftJoin('a.elementosCalzada', 'ec');
            $qb->andWhere('ec in (:elementoCalzada)');
            $qb->setParameter('elementoCalzada', $busqueda['elementoCalzada']);
        }

// Vehicular
        $qb->addSelect('vv');
        $qb->leftJoin('v.vehiculo', 'vv');

        if(array_key_exists('tipoVehiculo', $busqueda) and !$busqueda['tipoVehiculo']->isEmpty()) {
            $qb->addSelect('vvt');
            $qb->leftJoin('vv.tipoVehiculo', 'vvt');
            $qb->andWhere('vv.tipoVehiculo in (:tipoVehiculo)');
            $qb->setParameter('tipoVehiculo', $busqueda['tipoVehiculo']);
        }

        if(array_key_exists('servicioVehiculo', $busqueda) and !$busqueda['servicioVehiculo']->isEmpty()) {
            $qb->addSelect('vs');
            $qb->leftJoin('v.servicioVehiculo', 'vs');
            $qb->andWhere('v.servicioVehiculo in (:servicioVehiculo)');
            $qb->setParameter('servicioVehiculo', $busqueda['servicioVehiculo']);
        }

        if(array_key_exists('maniobraVehiculo', $busqueda) and !$busqueda['maniobraVehiculo']->isEmpty()) {
            $qb->addSelect('vm');
            $qb->leftJoin('v.maniobraVehiculo', 'vm');
            $qb->andWhere('v.maniobraVehiculo in (:maniobraVehiculo)');
            $qb->setParameter('maniobraVehiculo', $busqueda['maniobraVehiculo']);
        }

        if(array_key_exists('direccionVehiculo', $busqueda) and !$busqueda['direccionVehiculo']->isEmpty()) {
            $qb->addSelect('vd');
            $qb->leftJoin('v.direccionVehiculo', 'vd');
            $qb->andWhere('v.direccionVehiculo in (:direccionVehiculo)');
            $qb->setParameter('direccionVehiculo', $busqueda['direccionVehiculo']);
        }

        if(array_key_exists('consecuenciaVehiculo', $busqueda) and !$busqueda['consecuenciaVehiculo']->isEmpty()) {
            $qb->addSelect('vc');
            $qb->leftJoin('v.consecuenciaVehiculo', 'vc');
            $qb->andWhere('v.consecuenciaVehiculo in (:consecuenciaVehiculo)');
            $qb->setParameter('consecuenciaVehiculo', $busqueda['consecuenciaVehiculo']);
        }

// Personal
        $qb->addSelect('vca');
        $qb->leftJoin('v.conductorAccidente', 'vca');

        $qb->addSelect('vpa');
        $qb->leftJoin('v.pasajerosAccidente', 'vpa');

        $qb->addSelect('apa');
        $qb->leftJoin('a.peatonesAccidente', 'apa');

        if(array_key_exists('claseLicencia', $busqueda) and !$busqueda['claseLicencia']->isEmpty()) {
            $qb->addSelect('vcal');
            $qb->leftJoin('vca.claseLicencia', 'vcal');
            $qb->andWhere('vca.claseLicencia in (:claseLicencia)');
            $qb->setParameter('claseLicencia', $busqueda['claseLicencia']);
        }

        if(array_key_exists('comunaLicencia', $busqueda) and !$busqueda['comunaLicencia']->isEmpty()) {
            $qb->addSelect('vcac');
            $qb->leftJoin('vca.comunaLicencia', 'vcac');
            $qb->andWhere('vca.comunaLicencia in (:comunaLicencia)');
            $qb->setParameter('comunaLicencia', $busqueda['comunaLicencia']);
        }

        if(array_key_exists('condicionFisica', $busqueda) and !$busqueda['condicionFisica']->isEmpty()) {
            $qb->addSelect('vcacf');
            $qb->leftJoin('vca.condicionFisica', 'vcacf');

            $qb->addSelect('vpacf');
            $qb->leftJoin('apa.condicionFisica', 'vpacf');

            $qb->addSelect('apacf');
            $qb->leftJoin('apa.condicionFisica', 'apacf');

            $qb->andWhere('vca.condicionFisica in (:condicionFisica) or vpa.condicionFisica in (:condicionFisica) or apa.condicionFisica in (:condicionFisica)');
            $qb->setParameter('condicionFisica', $busqueda['condicionFisica']);
        }

        if(array_key_exists('consecuenciaPersona', $busqueda) and !$busqueda['consecuenciaPersona']->isEmpty()) {
            $qb->addSelect('vcacp');
            $qb->leftJoin('vca.consecuenciaPersona', 'vcacp');

            $qb->addSelect('vpacp');
            $qb->leftJoin('vpa.consecuenciaPersona', 'vpacp');

            $qb->addSelect('apacp');
            $qb->leftJoin('apa.consecuenciaPersona', 'apacp');

            $qb->andWhere('vca.consecuenciaPersona in (:consecuenciaPersona) or vpa.consecuenciaPersona in (:consecuenciaPersona) or apa.consecuenciaPersona in (:consecuenciaPersona)');
            $qb->setParameter('consecuenciaPersona', $busqueda['consecuenciaPersona']);
        }

        if(array_key_exists('cualidadEspecial', $busqueda) and !$busqueda['cualidadEspecial']->isEmpty()) {
            $qb->addSelect('vcace');
            $qb->leftJoin('vca.cualidadEspecial', 'vcace');

            $qb->addSelect('vpace');
            $qb->leftJoin('vpa.cualidadEspecial', 'vpace');

            $qb->addSelect('apace');
            $qb->leftJoin('apa.cualidadEspecial', 'apace');

            $qb->andWhere('vca.cualidadEspecial in (:cualidadEspecial) or vpa.cualidadEspecial in (:cualidadEspecial) or apa.cualidadEspecial in (:cualidadEspecial)');
            $qb->setParameter('cualidadEspecial', $busqueda['cualidadEspecial']);
        }

        if(array_key_exists('tipoTrayecto', $busqueda) and !$busqueda['tipoTrayecto']->isEmpty()) {
            $qb->addSelect('vcatt');
            $qb->leftJoin('vca.tipoTrayecto', 'vcatt');

            $qb->addSelect('vpatt');
            $qb->leftJoin('vpa.tipoTrayecto', 'vpatt');

            $qb->addSelect('apat');
            $qb->leftJoin('apa.tipoTrayecto', 'apatt');

            $qb->andWhere('vca.tipoTrayecto in (:tipoTrayecto) or vpa.tipoTrayecto in (:tipoTrayecto) or apa.tipoTrayecto in (:tipoTrayecto)');
            $qb->setParameter('tipoTrayecto', $busqueda['tipoTrayecto']);
        }

        if(array_key_exists('seguridadPersona', $busqueda) and !$busqueda['seguridadPersona']->isEmpty()) {
            $qb->addSelect('vcas');
            $qb->leftJoin('vca.seguridad', 'vcas');

            $qb->addSelect('vpas');
            $qb->leftJoin('vpa.seguridad', 'vpas');

            $qb->andWhere('vcas in (:seguridadPersona) or vpas in (:seguridadPersona)');
            $qb->setParameter('seguridadPersona', $busqueda['seguridadPersona']);
        }

        $query = $qb->getQuery();

        return $query;
    }

}
