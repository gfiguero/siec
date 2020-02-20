<?php

namespace App\Repository;

use App\Entity\Accidente;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Accidente|null find($id, $lockMode = null, $lockVersion = null)
 * @method Accidente|null findOneBy(array $criteria, array $orderBy = null)
 * @method Accidente[]    findAll()
 * @method Accidente[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AccidenteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Accidente::class);
    }

    /**
     * @return Accidente[] Returns an array of Accidente objects
     */
    public function findLast()
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.id', 'DESC')
//            ->setMaxResults(200)
            ->getQuery()
        ;
    }

    public function findMensajes()
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.esMensaje = 1')
            ->orderBy('a.id', 'DESC')
            ->getQuery()
        ;
    }

    public function test()
    {
        $qb = $this->createQueryBuilder('a');

        $qb->select('a');

//        $qb->addSelect('funcionario');
//        $qb->leftJoin('a.funcionario', 'funcionario');
//
//        $qb->addSelect('gradoCarabinero');
//        $qb->leftJoin('funcionario.gradoCarabinero', 'gradoCarabinero');
//
//        $qb->addSelect('tribunal');
//        $qb->leftJoin('a.tribunal', 'tribunal');
//
        $qb->addSelect('ubicacion');
        $qb->leftJoin('a.ubicacion', 'ubicacion');

        $qb->addSelect('cuadrante');
        $qb->leftJoin('a.cuadrante', 'cuadrante');

        $qb->addSelect('comuna');
        $qb->leftJoin('a.comuna', 'comuna');

        $qb->addSelect('provincia');
        $qb->leftJoin('comuna.provincia', 'provincia');

        $qb->addSelect('region');
        $qb->leftJoin('provincia.region', 'region');

//        $qb->addSelect('tipoDireccion');
//        $qb->leftJoin('a.tipoDireccion', 'tipoDireccion');
//
//        $qb->addSelect('tipoUbicacionRelativaAccidente');
//        $qb->leftJoin('a.tipoUbicacionRelativaAccidente', 'tipoUbicacionRelativaAccidente');
//
//        $qb->addSelect('tipoZonaAccidente');
//        $qb->leftJoin('a.tipoZonaAccidente', 'tipoZonaAccidente');

//        $qb->addSelect('incoherencias');
//        $qb->leftJoin('a.incoherencias', 'incoherencias');
//
//        $qb->addSelect('registroEtapas');
//        $qb->leftJoin('a.registroEtapas', 'registroEtapas');
//
//        $qb->addSelect('estadoAccidente');
//        $qb->leftJoin('a.estadoAccidente', 'estadoAccidente');

        $qb->addSelect('claseAccidente');
        $qb->leftJoin('a.claseAccidente', 'claseAccidente');

        $qb->addSelect('tipoAccidente');
        $qb->leftJoin('a.tipoAccidente', 'tipoAccidente');

        $qb->addSelect('causaBasal');
        $qb->leftJoin('a.causaBasal', 'causaBasal');

        $qb->addSelect('tipoCausa');
        $qb->leftJoin('causaBasal.tipoCausa', 'tipoCausa');

//        $qb->addSelect('estadoAtmosferico');
//        $qb->leftJoin('a.estadoAtmosferico', 'estadoAtmosferico');
//
//        $qb->addSelect('tipoLuminosidad');
//        $qb->leftJoin('a.tipoLuminosidad', 'tipoLuminosidad');
//
//        $qb->addSelect('estadoLuzArtificial');
//        $qb->leftJoin('a.estadoLuzArtificial', 'estadoLuzArtificial');
//
//        $qb->addSelect('tipoPavimentoCalzada');
//        $qb->leftJoin('a.tipoPavimentoCalzada', 'tipoPavimentoCalzada');
//
//        $qb->addSelect('condicionPavimentoCalzada');
//        $qb->leftJoin('a.condicionPavimentoCalzada', 'condicionPavimentoCalzada');
//
//        $qb->addSelect('estadoPavimentoCalzada');
//        $qb->leftJoin('a.estadoPavimentoCalzada', 'estadoPavimentoCalzada');
//
//        $qb->addSelect('tipoCalzada');
//        $qb->leftJoin('a.tipoCalzada', 'tipoCalzada');
//
//        $qb->addSelect('demarcacionLineaCalzada');
//        $qb->leftJoin('a.demarcacionLineaCalzada', 'demarcacionLineaCalzada');
//
//        $qb->addSelect('demarcacionPrioridadCalzada');
//        $qb->leftJoin('a.demarcacionPrioridadCalzada', 'demarcacionPrioridadCalzada');
//
//        $qb->addSelect('elementosCalzada');
//        $qb->leftJoin('a.elementosCalzada', 'elementosCalzada');

        $qb->addSelect('vehiculosAccidente');
        $qb->leftJoin('a.vehiculosAccidente', 'vehiculosAccidente');

        $qb->addSelect('vehiculo');
        $qb->leftJoin('vehiculosAccidente.vehiculo', 'vehiculo');

        $qb->addSelect('tipoVehiculo');
        $qb->leftJoin('vehiculo.tipoVehiculo', 'tipoVehiculo');

        $qb->addSelect('servicioVehiculo');
        $qb->leftJoin('vehiculosAccidente.servicioVehiculo', 'servicioVehiculo');

        $qb->addSelect('maniobraVehiculo');
        $qb->leftJoin('vehiculosAccidente.maniobraVehiculo', 'maniobraVehiculo');

        $qb->addSelect('direccionVehiculo');
        $qb->leftJoin('vehiculosAccidente.direccionVehiculo', 'direccionVehiculo');

        $qb->addSelect('consecuenciaVehiculo');
        $qb->leftJoin('vehiculosAccidente.consecuenciaVehiculo', 'consecuenciaVehiculo');

//        $qb->addSelect('conductorAccidente');
//        $qb->leftJoin('vehiculosAccidente.conductorAccidente', 'conductorAccidente');
//
//        $qb->addSelect('claseLicencia');
//        $qb->leftJoin('conductorAccidente.claseLicencia', 'claseLicencia');
//
//        $qb->addSelect('comunaLicencia');
//        $qb->leftJoin('conductorAccidente.comunaLicencia', 'comunaLicencia');
//
//        $qb->addSelect('pasajerosAccidente');
//        $qb->leftJoin('vehiculosAccidente.pasajerosAccidente', 'pasajerosAccidente');
//
//        $qb->addSelect('peatonesAccidente');
//        $qb->leftJoin('a.peatonesAccidente', 'peatonesAccidente');
//
//        $qb->addSelect('conductorAccidenteCondicionFisica');
//        $qb->leftJoin('conductorAccidente.condicionFisica', 'conductorAccidenteCondicionFisica');
//
//        $qb->addSelect('pasajerosAccidenteCondicionFisica');
//        $qb->leftJoin('pasajerosAccidente.condicionFisica', 'pasajerosAccidenteCondicionFisica');
//
//        $qb->addSelect('peatonesAccidenteCondicionFisica');
//        $qb->leftJoin('peatonesAccidente.condicionFisica', 'peatonesAccidenteCondicionFisica');
//
//        $qb->addSelect('conductorAccidenteConsecuenciaPersona');
//        $qb->leftJoin('conductorAccidente.consecuenciaPersona', 'conductorAccidenteConsecuenciaPersona');
//
//        $qb->addSelect('pasajerosAccidenteConsecuenciaPersona');
//        $qb->leftJoin('pasajerosAccidente.consecuenciaPersona', 'pasajerosAccidenteConsecuenciaPersona');
//
//        $qb->addSelect('peatonesAccidenteConsecuenciaPersona');
//        $qb->leftJoin('peatonesAccidente.consecuenciaPersona', 'peatonesAccidenteConsecuenciaPersona');
//
//        $qb->addSelect('conductorAccidenteCualidadEspecial');
//        $qb->leftJoin('conductorAccidente.cualidadEspecial', 'conductorAccidenteCualidadEspecial');
//
//        $qb->addSelect('pasajerosAccidenteCualidadEspecial');
//        $qb->leftJoin('pasajerosAccidente.cualidadEspecial', 'pasajerosAccidenteCualidadEspecial');
//
//        $qb->addSelect('peatonesAccidenteCualidadEspecial');
//        $qb->leftJoin('peatonesAccidente.cualidadEspecial', 'peatonesAccidenteCualidadEspecial');
//
//        $qb->addSelect('conductorAccidenteTipoTrayecto');
//        $qb->leftJoin('conductorAccidente.tipoTrayecto', 'conductorAccidenteTipoTrayecto');
//
//        $qb->addSelect('pasajerosAccidenteTipoTrayecto');
//        $qb->leftJoin('pasajerosAccidente.tipoTrayecto', 'pasajerosAccidenteTipoTrayecto');
//
//        $qb->addSelect('peatonesAccidenteTipoTrayecto');
//        $qb->leftJoin('peatonesAccidente.tipoTrayecto', 'peatonesAccidenteTipoTrayecto');
//
//        $qb->addSelect('conductorAccidenteSeguridad');
//        $qb->leftJoin('conductorAccidente.seguridad', 'conductorAccidenteSeguridad');
//
//        $qb->addSelect('pasajerosAccidenteSeguridad');
//        $qb->leftJoin('pasajerosAccidente.seguridad', 'pasajerosAccidenteSeguridad');

        $qb->andWhere('tipoVehiculo IN (:tipoVehiculo)');
        $qb->setParameter('tipoVehiculo', array(1,2,3,4));

        $qb->andWhere('claseAccidente IN (:claseAccidente)');
        $qb->setParameter('claseAccidente', array(1,2,3,4));

        $query = $qb->getQuery();

        return $query;
    }

    public function filtroAccidenteVehiculo($busqueda = array())
    {
        $qb = $this->createQueryBuilder('a');

        $qb->select('a');

// Básicos

    // Peatones Accidente
        $qb->addSelect('peatonesAccidente');
        $qb->leftJoin('a.peatonesAccidente', 'peatonesAccidente');

    // Vehículos Accidente
        $qb->addSelect('vehiculosAccidente');
        $qb->leftJoin('a.vehiculosAccidente', 'vehiculosAccidente');

    // Pasajeros Accidente
        $qb->addSelect('pasajerosAccidente');
        $qb->leftJoin('vehiculosAccidente.pasajerosAccidente', 'pasajerosAccidente');

    // Conductores Accidente
        $qb->addSelect('conductorAccidente');
        $qb->leftJoin('vehiculosAccidente.conductorAccidente', 'conductorAccidente');

    // Consecuencias Persona
        $qb->addSelect('conductorAccidenteConsecuenciaPersona');
        $qb->leftJoin('conductorAccidente.consecuenciaPersona', 'conductorAccidenteConsecuenciaPersona');

        $qb->addSelect('pasajerosAccidenteConsecuenciaPersona');
        $qb->leftJoin('pasajerosAccidente.consecuenciaPersona', 'pasajerosAccidenteConsecuenciaPersona');

        $qb->addSelect('peatonesAccidenteConsecuenciaPersona');
        $qb->leftJoin('peatonesAccidente.consecuenciaPersona', 'peatonesAccidenteConsecuenciaPersona');



// Territorial

    // Ubicación
        $qb->addSelect('ubicacion');
        $qb->leftJoin('a.ubicacion', 'ubicacion');

    // Cuadrante
        $qb->addSelect('cuadrante');
        $qb->leftJoin('a.cuadrante', 'cuadrante');

        if(array_key_exists('cuadrante', $busqueda) and !$busqueda['cuadrante']->isEmpty()) {
            $qb->andWhere('cuadrante in (:cuadrante)');
            $qb->setParameter('cuadrante', $busqueda['cuadrante']);
        }

    // Comuna
        $qb->addSelect('comuna');
        $qb->leftJoin('a.comuna', 'comuna');

        if(array_key_exists('comuna', $busqueda) and !$busqueda['comuna']->isEmpty()) {
            $qb->andWhere('comuna in (:comuna)');
            $qb->setParameter('comuna', $busqueda['comuna']);
        }

    // Provincia
        $qb->addSelect('provincia');
        $qb->leftJoin('comuna.provincia', 'provincia');

        if(array_key_exists('provincia', $busqueda) and !$busqueda['provincia']->isEmpty()) {
            $qb->andWhere('provincia in (:provincia)');
            $qb->setParameter('provincia', $busqueda['provincia']);
        }

    // Región
        $qb->addSelect('region');
        $qb->leftJoin('provincia.region', 'region');

        if(array_key_exists('region', $busqueda) and !$busqueda['region']->isEmpty()) {
            $qb->andWhere('region in (:region)');
            $qb->setParameter('region', $busqueda['region']);
        }

// Cualitativa

    // Clase Accidente
        $qb->addSelect('claseAccidente');
        $qb->leftJoin('a.claseAccidente', 'claseAccidente');

        if(array_key_exists('claseAccidente', $busqueda) and !$busqueda['claseAccidente']->isEmpty()) {
            $qb->andWhere('claseAccidente in (:claseAccidente)');
            $qb->setParameter('claseAccidente', $busqueda['claseAccidente']);
        }

    // Tipo Accidente
        $qb->addSelect('tipoAccidente');
        $qb->leftJoin('a.tipoAccidente', 'tipoAccidente');

        if(array_key_exists('tipoAccidente', $busqueda) and !$busqueda['tipoAccidente']->isEmpty()) {
            $qb->andWhere('tipoAccidente in (:tipoAccidente)');
            $qb->setParameter('tipoAccidente', $busqueda['tipoAccidente']);
        }

    // Causa Basal
        $qb->addSelect('causaBasal');
        $qb->leftJoin('a.causaBasal', 'causaBasal');

        if(array_key_exists('causaBasal', $busqueda) and !$busqueda['causaBasal']->isEmpty()) {
            $qb->andWhere('causaBasal in (:causaBasal)');
            $qb->setParameter('causaBasal', $busqueda['causaBasal']);
        }

    // Tipo Causa
        $qb->addSelect('tipoCausa');
        $qb->leftJoin('causaBasal.tipoCausa', 'tipoCausa');

        if(array_key_exists('tipoCausa', $busqueda) and !$busqueda['tipoCausa']->isEmpty()) {
            $qb->andWhere('causaBasal.tipoCausa in (:tipoCausa)');
            $qb->setParameter('tipoCausa', $busqueda['tipoCausa']);
        }

// Vehicular

    // Vehículo
        $qb->addSelect('vehiculo');
        $qb->leftJoin('vehiculosAccidente.vehiculo', 'vehiculo');

    // Tipo Vehículo
        $qb->addSelect('tipoVehiculo');
        $qb->leftJoin('vehiculo.tipoVehiculo', 'tipoVehiculo');

        if(array_key_exists('tipoVehiculo', $busqueda) and !$busqueda['tipoVehiculo']->isEmpty()) {
            $qb->andWhere('tipoVehiculo IN (:tipoVehiculo)');
            $qb->setParameter('tipoVehiculo', $busqueda['tipoVehiculo']);
        }

    // Servicio Vehículo
        $qb->addSelect('servicioVehiculo');
        $qb->leftJoin('vehiculosAccidente.servicioVehiculo', 'servicioVehiculo');

        if(array_key_exists('servicioVehiculo', $busqueda) and !$busqueda['servicioVehiculo']->isEmpty()) {
            $qb->andWhere('servicioVehiculo IN (:servicioVehiculo)');
            $qb->setParameter('servicioVehiculo', $busqueda['servicioVehiculo']);
        }

    // Maniobra Vehículo
        $qb->addSelect('maniobraVehiculo');
        $qb->leftJoin('vehiculosAccidente.maniobraVehiculo', 'maniobraVehiculo');

        if(array_key_exists('maniobraVehiculo', $busqueda) and !$busqueda['maniobraVehiculo']->isEmpty()) {
            $qb->andWhere('maniobraVehiculo IN (:maniobraVehiculo)');
            $qb->setParameter('maniobraVehiculo', $busqueda['maniobraVehiculo']);
        }

    // Dirección Vehículo
        $qb->addSelect('direccionVehiculo');
        $qb->leftJoin('vehiculosAccidente.direccionVehiculo', 'direccionVehiculo');

        if(array_key_exists('direccionVehiculo', $busqueda) and !$busqueda['direccionVehiculo']->isEmpty()) {
            $qb->andWhere('direccionVehiculo IN (:direccionVehiculo)');
            $qb->setParameter('direccionVehiculo', $busqueda['direccionVehiculo']);
        }

    // Consecuencia Vehículo
        $qb->addSelect('consecuenciaVehiculo');
        $qb->leftJoin('vehiculosAccidente.consecuenciaVehiculo', 'consecuenciaVehiculo');

        if(array_key_exists('consecuenciaVehiculo', $busqueda) and !$busqueda['consecuenciaVehiculo']->isEmpty()) {
            $qb->andWhere('consecuenciaVehiculo IN (:consecuenciaVehiculo)');
            $qb->setParameter('consecuenciaVehiculo', $busqueda['consecuenciaVehiculo']);
        }

        $query = $qb->getQuery();

        return $query;
    }

    public function filtroAccidentePersona($busqueda = array())
    {
        $qb = $this->createQueryBuilder('a');

        $qb->select('a');

// Básicos

    // Peatones Accidente
        $qb->addSelect('peatonesAccidente');
        $qb->leftJoin('a.peatonesAccidente', 'peatonesAccidente');

    // Vehículos Accidente
        $qb->addSelect('vehiculosAccidente');
        $qb->leftJoin('a.vehiculosAccidente', 'vehiculosAccidente');

    // Pasajeros Accidente
        $qb->addSelect('pasajerosAccidente');
        $qb->leftJoin('vehiculosAccidente.pasajerosAccidente', 'pasajerosAccidente');

    // Conductores Accidente
        $qb->addSelect('conductorAccidente');
        $qb->leftJoin('vehiculosAccidente.conductorAccidente', 'conductorAccidente');

    // Consecuencias Persona
        $qb->addSelect('conductorAccidenteConsecuenciaPersona');
        $qb->leftJoin('conductorAccidente.consecuenciaPersona', 'conductorAccidenteConsecuenciaPersona');

        $qb->addSelect('pasajerosAccidenteConsecuenciaPersona');
        $qb->leftJoin('pasajerosAccidente.consecuenciaPersona', 'pasajerosAccidenteConsecuenciaPersona');

        $qb->addSelect('peatonesAccidenteConsecuenciaPersona');
        $qb->leftJoin('peatonesAccidente.consecuenciaPersona', 'peatonesAccidenteConsecuenciaPersona');

// Territorial

    // Ubicación
        $qb->addSelect('ubicacion');
        $qb->leftJoin('a.ubicacion', 'ubicacion');

    // Cuadrante
        $qb->addSelect('cuadrante');
        $qb->leftJoin('a.cuadrante', 'cuadrante');

        if(array_key_exists('cuadrante', $busqueda) and !$busqueda['cuadrante']->isEmpty()) {
            $qb->andWhere('cuadrante in (:cuadrante)');
            $qb->setParameter('cuadrante', $busqueda['cuadrante']);
        }

    // Comuna
        $qb->addSelect('comuna');
        $qb->leftJoin('a.comuna', 'comuna');

        if(array_key_exists('comuna', $busqueda) and !$busqueda['comuna']->isEmpty()) {
            $qb->andWhere('comuna in (:comuna)');
            $qb->setParameter('comuna', $busqueda['comuna']);
        }

    // Provincia
        $qb->addSelect('provincia');
        $qb->leftJoin('comuna.provincia', 'provincia');

        if(array_key_exists('provincia', $busqueda) and !$busqueda['provincia']->isEmpty()) {
            $qb->andWhere('provincia in (:provincia)');
            $qb->setParameter('provincia', $busqueda['provincia']);
        }

    // Región
        $qb->addSelect('region');
        $qb->leftJoin('provincia.region', 'region');

        if(array_key_exists('region', $busqueda) and !$busqueda['region']->isEmpty()) {
            $qb->andWhere('region in (:region)');
            $qb->setParameter('region', $busqueda['region']);
        }

// Cualitativa

    // Clase Accidente
        $qb->addSelect('claseAccidente');
        $qb->leftJoin('a.claseAccidente', 'claseAccidente');

        if(array_key_exists('claseAccidente', $busqueda) and !$busqueda['claseAccidente']->isEmpty()) {
            $qb->andWhere('claseAccidente in (:claseAccidente)');
            $qb->setParameter('claseAccidente', $busqueda['claseAccidente']);
        }

    // Tipo Accidente
        $qb->addSelect('tipoAccidente');
        $qb->leftJoin('a.tipoAccidente', 'tipoAccidente');

        if(array_key_exists('tipoAccidente', $busqueda) and !$busqueda['tipoAccidente']->isEmpty()) {
            $qb->andWhere('tipoAccidente in (:tipoAccidente)');
            $qb->setParameter('tipoAccidente', $busqueda['tipoAccidente']);
        }

    // Causa Basal
        $qb->addSelect('causaBasal');
        $qb->leftJoin('a.causaBasal', 'causaBasal');

        if(array_key_exists('causaBasal', $busqueda) and !$busqueda['causaBasal']->isEmpty()) {
            $qb->andWhere('causaBasal in (:causaBasal)');
            $qb->setParameter('causaBasal', $busqueda['causaBasal']);
        }

    // Tipo Causa
        $qb->addSelect('tipoCausa');
        $qb->leftJoin('causaBasal.tipoCausa', 'tipoCausa');

        if(array_key_exists('tipoCausa', $busqueda) and !$busqueda['tipoCausa']->isEmpty()) {
            $qb->andWhere('causaBasal.tipoCausa in (:tipoCausa)');
            $qb->setParameter('tipoCausa', $busqueda['tipoCausa']);
        }

        $query = $qb->getQuery();

        return $query;
    }

    public function findInspeccion($busqueda = array())
    {
        $qb = $this->createQueryBuilder('a');

        $qb->select('a');

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

    // Unidad
        $qb->addSelect('unidad');
        $qb->leftJoin('a.unidad', 'unidad');

        if(array_key_exists('unidad', $busqueda) and !$busqueda['unidad']->isEmpty()) {
            $qb->andWhere('unidad in (:unidad)');
            $qb->setParameter('unidad', $busqueda['unidad']);
        }

    // Funcionario
        $qb->addSelect('funcionario');
        $qb->leftJoin('a.funcionario', 'funcionario');

        if(array_key_exists('funcionario', $busqueda) and !$busqueda['funcionario']->isEmpty()) {
            $qb->andWhere('funcionario in (:funcionario)');
            $qb->setParameter('funcionario', $busqueda['funcionario']);
        }

    // Grado Carabinero
        $qb->addSelect('gradoCarabinero');
        $qb->leftJoin('funcionario.gradoCarabinero', 'gradoCarabinero');

    // Tribunal
        $qb->addSelect('tribunal');
        $qb->leftJoin('a.tribunal', 'tribunal');

        if(array_key_exists('tribunal', $busqueda) and !$busqueda['tribunal']->isEmpty()) {
            $qb->andWhere('tribunal in (:tribunal)');
            $qb->setParameter('tribunal', $busqueda['tribunal']);
        }

    // Numero Parte
        if(array_key_exists('numeroParte', $busqueda) and $busqueda['numeroParte']) {
            $qb->andWhere('a.numeroParte = :numeroParte');
            $qb->setParameter('numeroParte', $busqueda['numeroParte']);
        }

    // Numero Formulario
        if(array_key_exists('numeroFormulario', $busqueda) and $busqueda['numeroFormulario']) {
            $qb->andWhere('a.numeroFormulario = :numeroFormulario');
            $qb->setParameter('numeroFormulario', $busqueda['numeroFormulario']);
        }

    // Es Mensaje
        if(array_key_exists('esMensaje', $busqueda) and $busqueda['esMensaje']) {
            $qb->andWhere('a.esMensaje = TRUE');
        }

    // Concurre SIAT
        if(array_key_exists('concurreSiat', $busqueda) and $busqueda['concurreSiat']) {
            $qb->andWhere('a.concurreSiat = TRUE');
        }

// Territorial

    // Ubicación
        $qb->addSelect('ubicacion');
        $qb->leftJoin('a.ubicacion', 'ubicacion');

    // Cuadrante
        $qb->addSelect('cuadrante');
        $qb->leftJoin('a.cuadrante', 'cuadrante');

        if(array_key_exists('cuadrante', $busqueda) and !$busqueda['cuadrante']->isEmpty()) {
            $qb->andWhere('cuadrante in (:cuadrante)');
            $qb->setParameter('cuadrante', $busqueda['cuadrante']);
        }

    // Comuna
        $qb->addSelect('comuna');
        $qb->leftJoin('a.comuna', 'comuna');

        if(array_key_exists('comuna', $busqueda) and !$busqueda['comuna']->isEmpty()) {
            $qb->andWhere('comuna in (:comuna)');
            $qb->setParameter('comuna', $busqueda['comuna']);
        }

    // Provincia
        $qb->addSelect('provincia');
        $qb->leftJoin('comuna.provincia', 'provincia');

        if(array_key_exists('provincia', $busqueda) and !$busqueda['provincia']->isEmpty()) {
            $qb->andWhere('provincia in (:provincia)');
            $qb->setParameter('provincia', $busqueda['provincia']);
        }

    // Región
        $qb->addSelect('region');
        $qb->leftJoin('provincia.region', 'region');

        if(array_key_exists('region', $busqueda) and !$busqueda['region']->isEmpty()) {
            $qb->andWhere('region in (:region)');
            $qb->setParameter('region', $busqueda['region']);
        }

// Relativos

    // Tipo Dirección
        $qb->addSelect('tipoDireccion');
        $qb->leftJoin('a.tipoDireccion', 'tipoDireccion');

        if(array_key_exists('tipoDireccion', $busqueda) and !$busqueda['tipoDireccion']->isEmpty()) {
            $qb->andWhere('tipoDireccion in (:tipoDireccion)');
            $qb->setParameter('tipoDireccion', $busqueda['tipoDireccion']);
        }

    // Tipo Ubicación Relativa
        $qb->addSelect('tipoUbicacionRelativaAccidente');
        $qb->leftJoin('a.tipoUbicacionRelativaAccidente', 'tipoUbicacionRelativaAccidente');

        if(array_key_exists('tipoUbicacionRelativaAccidente', $busqueda) and !$busqueda['tipoUbicacionRelativaAccidente']->isEmpty()) {
            $qb->andWhere('tipoUbicacionRelativaAccidente in (:tipoUbicacionRelativaAccidente)');
            $qb->setParameter('tipoUbicacionRelativaAccidente', $busqueda['tipoUbicacionRelativaAccidente']);
        }

    // Tipo Zona
        $qb->addSelect('tipoZonaAccidente');
        $qb->leftJoin('a.tipoZonaAccidente', 'tipoZonaAccidente');

        if(array_key_exists('tipoZonaAccidente', $busqueda) and !$busqueda['tipoZonaAccidente']->isEmpty()) {
            $qb->andWhere('tipoZonaAccidente in (:tipoZonaAccidente)');
            $qb->setParameter('tipoZonaAccidente', $busqueda['tipoZonaAccidente']);
        }

// Lógica

    // Incoherencias
        $qb->addSelect('incoherencias');
        $qb->leftJoin('a.incoherencias', 'incoherencias');

        if(array_key_exists('incoherencias', $busqueda) and !$busqueda['incoherencias']->isEmpty()) {
            $qb->andWhere('incoherencias in (:incoherencias)');
            $qb->setParameter('incoherencias', $busqueda['incoherencias']);
        }

    // Registro Etapas
        $qb->addSelect('registroEtapas');
        $qb->leftJoin('a.registroEtapas', 'registroEtapas');

        if(array_key_exists('registroEtapas', $busqueda) and !$busqueda['registroEtapas']->isEmpty()) {
            $qb->andWhere('registroEtapas in (:registroEtapas)');
            $qb->setParameter('registroEtapas', $busqueda['registroEtapas']);
        }

    // Estado Accidente
        $qb->addSelect('estadoAccidente');
        $qb->leftJoin('a.estadoAccidente', 'estadoAccidente');

        if(array_key_exists('estadoAccidente', $busqueda) and !$busqueda['estadoAccidente']->isEmpty()) {
            $qb->andWhere('estadoAccidente in (:estadoAccidente)');
            $qb->setParameter('estadoAccidente', $busqueda['estadoAccidente']);
        }

// Cualitativa

    // Clase Accidente
        $qb->addSelect('claseAccidente');
        $qb->leftJoin('a.claseAccidente', 'claseAccidente');

        if(array_key_exists('claseAccidente', $busqueda) and !$busqueda['claseAccidente']->isEmpty()) {
            $qb->andWhere('claseAccidente in (:claseAccidente)');
            $qb->setParameter('claseAccidente', $busqueda['claseAccidente']);
        }

    // Tipo Accidente
        $qb->addSelect('tipoAccidente');
        $qb->leftJoin('a.tipoAccidente', 'tipoAccidente');

        if(array_key_exists('tipoAccidente', $busqueda) and !$busqueda['tipoAccidente']->isEmpty()) {
            $qb->andWhere('tipoAccidente in (:tipoAccidente)');
            $qb->setParameter('tipoAccidente', $busqueda['tipoAccidente']);
        }

    // Causa Basal
        $qb->addSelect('causaBasal');
        $qb->leftJoin('a.causaBasal', 'causaBasal');

        if(array_key_exists('causaBasal', $busqueda) and !$busqueda['causaBasal']->isEmpty()) {
            $qb->andWhere('causaBasal in (:causaBasal)');
            $qb->setParameter('causaBasal', $busqueda['causaBasal']);
        }

    // Tipo Causa
        $qb->addSelect('tipoCausa');
        $qb->leftJoin('causaBasal.tipoCausa', 'tipoCausa');

        if(array_key_exists('tipoCausa', $busqueda) and !$busqueda['tipoCausa']->isEmpty()) {
            $qb->andWhere('causaBasal.tipoCausa in (:tipoCausa)');
            $qb->setParameter('tipoCausa', $busqueda['tipoCausa']);
        }

// Circunstancial

    // Estado Atmosférico
        $qb->addSelect('estadoAtmosferico');
        $qb->leftJoin('a.estadoAtmosferico', 'estadoAtmosferico');

        if(array_key_exists('estadoAtmosferico', $busqueda) and !$busqueda['estadoAtmosferico']->isEmpty()) {
            $qb->andWhere('estadoAtmosferico in (:estadoAtmosferico)');
            $qb->setParameter('estadoAtmosferico', $busqueda['estadoAtmosferico']);
        }

    // Tipo Luminosidad
        $qb->addSelect('tipoLuminosidad');
        $qb->leftJoin('a.tipoLuminosidad', 'tipoLuminosidad');

        if(array_key_exists('tipoLuminosidad', $busqueda) and !$busqueda['tipoLuminosidad']->isEmpty()) {
            $qb->andWhere('tipoLuminosidad in (:tipoLuminosidad)');
            $qb->setParameter('tipoLuminosidad', $busqueda['tipoLuminosidad']);
        }

    // Estado Luz Artificial
        $qb->addSelect('estadoLuzArtificial');
        $qb->leftJoin('a.estadoLuzArtificial', 'estadoLuzArtificial');

        if(array_key_exists('estadoLuzArtificial', $busqueda) and !$busqueda['estadoLuzArtificial']->isEmpty()) {
            $qb->andWhere('estadoLuzArtificial in (:estadoLuzArtificial)');
            $qb->setParameter('estadoLuzArtificial', $busqueda['estadoLuzArtificial']);
        }

    // Tipo Pavimento Calzada
        $qb->addSelect('tipoPavimentoCalzada');
        $qb->leftJoin('a.tipoPavimentoCalzada', 'tipoPavimentoCalzada');

        if(array_key_exists('tipoPavimentoCalzada', $busqueda) and !$busqueda['tipoPavimentoCalzada']->isEmpty()) {
            $qb->andWhere('tipoPavimentoCalzada in (:tipoPavimentoCalzada)');
            $qb->setParameter('tipoPavimentoCalzada', $busqueda['tipoPavimentoCalzada']);
        }

    // Condición Pavimento Calzada
        $qb->addSelect('condicionPavimentoCalzada');
        $qb->leftJoin('a.condicionPavimentoCalzada', 'condicionPavimentoCalzada');

        if(array_key_exists('condicionPavimentoCalzada', $busqueda) and !$busqueda['condicionPavimentoCalzada']->isEmpty()) {
            $qb->andWhere('condicionPavimentoCalzada in (:condicionPavimentoCalzada)');
            $qb->setParameter('condicionPavimentoCalzada', $busqueda['condicionPavimentoCalzada']);
        }

    // Estado Pavimento Calzada
        $qb->addSelect('estadoPavimentoCalzada');
        $qb->leftJoin('a.estadoPavimentoCalzada', 'estadoPavimentoCalzada');

        if(array_key_exists('estadoPavimentoCalzada', $busqueda) and !$busqueda['estadoPavimentoCalzada']->isEmpty()) {
            $qb->andWhere('estadoPavimentoCalzada in (:estadoPavimentoCalzada)');
            $qb->setParameter('estadoPavimentoCalzada', $busqueda['estadoPavimentoCalzada']);
        }

    // Tipo Calzada
        $qb->addSelect('tipoCalzada');
        $qb->leftJoin('a.tipoCalzada', 'tipoCalzada');

        if(array_key_exists('tipoCalzada', $busqueda) and !$busqueda['tipoCalzada']->isEmpty()) {
            $qb->andWhere('tipoCalzada in (:tipoCalzada)');
            $qb->setParameter('tipoCalzada', $busqueda['tipoCalzada']);
        }

    // Demarcación Línea Calzada
        $qb->addSelect('demarcacionLineaCalzada');
        $qb->leftJoin('a.demarcacionLineaCalzada', 'demarcacionLineaCalzada');

        if(array_key_exists('demarcacionLineaCalzada', $busqueda) and !$busqueda['demarcacionLineaCalzada']->isEmpty()) {
            $qb->andWhere('demarcacionLineaCalzada in (:demarcacionLineaCalzada)');
            $qb->setParameter('demarcacionLineaCalzada', $busqueda['demarcacionLineaCalzada']);
        }

    // Demarcación Prioridad Calzada
        $qb->addSelect('demarcacionPrioridadCalzada');
        $qb->leftJoin('a.demarcacionPrioridadCalzada', 'demarcacionPrioridadCalzada');

        if(array_key_exists('demarcacionPrioridadCalzada', $busqueda) and !$busqueda['demarcacionPrioridadCalzada']->isEmpty()) {
            $qb->andWhere('demarcacionPrioridadCalzada in (:demarcacionPrioridadCalzada)');
            $qb->setParameter('demarcacionPrioridadCalzada', $busqueda['demarcacionPrioridadCalzada']);
        }

//    // Elemento Calzada
//        $qb->addSelect('elementosCalzada');
//        $qb->leftJoin('a.elementosCalzada', 'elementosCalzada');
//
//        if(array_key_exists('elementosCalzada', $busqueda) and !$busqueda['elementosCalzada']->isEmpty()) {
//            $qb->andWhere('elementosCalzada in (:elementosCalzada)');
//            $qb->setParameter('elementosCalzada', $busqueda['elementosCalzada']);
//        }

// Vehicular

//    // Vehículos Accidente
//        $qb->addSelect('vehiculosAccidente');
//        $qb->leftJoin('a.vehiculosAccidente', 'vehiculosAccidente');
//
//    // Vehículo
//        $qb->addSelect('vehiculo');
//        $qb->leftJoin('vehiculosAccidente.vehiculo', 'vehiculo');
//
//    // Tipo Vehículo
//        $qb->addSelect('tipoVehiculo');
//        $qb->leftJoin('vehiculo.tipoVehiculo', 'tipoVehiculo');
//
//        if(array_key_exists('tipoVehiculo', $busqueda) and $busqueda['tipoVehiculo']) {
//            $qb->andWhere('tipoVehiculo = :tipoVehiculo');
//            $qb->setParameter('tipoVehiculo', $busqueda['tipoVehiculo']);
//        }
//
//    // Servicio Vehículo
//        $qb->addSelect('servicioVehiculo');
//        $qb->leftJoin('vehiculosAccidente.servicioVehiculo', 'servicioVehiculo');
//
//        if(array_key_exists('servicioVehiculo', $busqueda) and $busqueda['servicioVehiculo']) {
//            $qb->andWhere('servicioVehiculo = :servicioVehiculo');
//            $qb->setParameter('servicioVehiculo', $busqueda['servicioVehiculo']);
//        }
//
//    // Maniobra Vehículo
//        $qb->addSelect('maniobraVehiculo');
//        $qb->leftJoin('vehiculosAccidente.maniobraVehiculo', 'maniobraVehiculo');
//
//        if(array_key_exists('maniobraVehiculo', $busqueda) and $busqueda['maniobraVehiculo']) {
//            $qb->andWhere('maniobraVehiculo = :maniobraVehiculo');
//            $qb->setParameter('maniobraVehiculo', $busqueda['maniobraVehiculo']);
//        }
//
//    // Dirección Vehículo
//        $qb->addSelect('direccionVehiculo');
//        $qb->leftJoin('vehiculosAccidente.direccionVehiculo', 'direccionVehiculo');
//
//        if(array_key_exists('direccionVehiculo', $busqueda) and $busqueda['direccionVehiculo']) {
//            $qb->andWhere('direccionVehiculo = :direccionVehiculo');
//            $qb->setParameter('direccionVehiculo', $busqueda['direccionVehiculo']);
//        }
//
//    // Consecuencia Vehículo
//        $qb->addSelect('consecuenciaVehiculo');
//        $qb->leftJoin('vehiculosAccidente.consecuenciaVehiculo', 'consecuenciaVehiculo');
//
//        if(array_key_exists('consecuenciaVehiculo', $busqueda) and $busqueda['consecuenciaVehiculo']) {
//            $qb->andWhere('consecuenciaVehiculo = :consecuenciaVehiculo');
//            $qb->setParameter('consecuenciaVehiculo', $busqueda['consecuenciaVehiculo']);
//        }

// Personal

//    // Conductores
//        $qb->addSelect('conductorAccidente');
//        $qb->leftJoin('vehiculosAccidente.conductorAccidente', 'conductorAccidente');
//
//    // Clase Licencia
//        $qb->addSelect('claseLicencia');
//        $qb->leftJoin('conductorAccidente.claseLicencia', 'claseLicencia');
//
//        if(array_key_exists('claseLicencia', $busqueda) and !$busqueda['claseLicencia']->isEmpty()) {
//            $qb->andWhere('claseLicencia in (:claseLicencia)');
//            $qb->setParameter('claseLicencia', $busqueda['claseLicencia']);
//        }
//
//    // Comuna Licencia
//        $qb->addSelect('comunaLicencia');
//        $qb->leftJoin('conductorAccidente.comunaLicencia', 'comunaLicencia');
//
//        if(array_key_exists('comunaLicencia', $busqueda) and !$busqueda['comunaLicencia']->isEmpty()) {
//            $qb->andWhere('comunaLicencia in (:comunaLicencia)');
//            $qb->setParameter('comunaLicencia', $busqueda['comunaLicencia']);
//        }
//
//    // Pasajeros Accidente
//        $qb->addSelect('pasajerosAccidente');
//        $qb->leftJoin('vehiculosAccidente.pasajerosAccidente', 'pasajerosAccidente');
//
//    // Peatones Accidente
//        $qb->addSelect('peatonesAccidente');
//        $qb->leftJoin('a.peatonesAccidente', 'peatonesAccidente');
//
//    // Condición Física
//        $qb->addSelect('conductorAccidenteCondicionFisica');
//        $qb->leftJoin('conductorAccidente.condicionFisica', 'conductorAccidenteCondicionFisica');
//
//        $qb->addSelect('pasajerosAccidenteCondicionFisica');
//        $qb->leftJoin('pasajerosAccidente.condicionFisica', 'pasajerosAccidenteCondicionFisica');
//
//        $qb->addSelect('peatonesAccidenteCondicionFisica');
//        $qb->leftJoin('peatonesAccidente.condicionFisica', 'peatonesAccidenteCondicionFisica');
//
//        if(array_key_exists('condicionFisica', $busqueda) and !$busqueda['condicionFisica']->isEmpty()) {
//            $qb->andWhere('conductorAccidenteCondicionFisica in (:condicionFisica) or pasajerosAccidenteCondicionFisica in (:condicionFisica) or peatonesAccidenteCondicionFisica in (:condicionFisica)');
//            $qb->setParameter('condicionFisica', $busqueda['condicionFisica']);
//        }
//
//    // Consecuencia Persona
//        $qb->addSelect('conductorAccidenteConsecuenciaPersona');
//        $qb->leftJoin('conductorAccidente.consecuenciaPersona', 'conductorAccidenteConsecuenciaPersona');
//
//        $qb->addSelect('pasajerosAccidenteConsecuenciaPersona');
//        $qb->leftJoin('pasajerosAccidente.consecuenciaPersona', 'pasajerosAccidenteConsecuenciaPersona');
//
//        $qb->addSelect('peatonesAccidenteConsecuenciaPersona');
//        $qb->leftJoin('peatonesAccidente.consecuenciaPersona', 'peatonesAccidenteConsecuenciaPersona');
//
//        if(array_key_exists('consecuenciaPersona', $busqueda) and !$busqueda['consecuenciaPersona']->isEmpty()) {
//            $qb->andWhere('conductorAccidenteConsecuenciaPersona in (:consecuenciaPersona) or pasajerosAccidenteConsecuenciaPersona in (:consecuenciaPersona) or peatonesAccidenteConsecuenciaPersona in (:consecuenciaPersona)');
//            $qb->setParameter('consecuenciaPersona', $busqueda['consecuenciaPersona']);
//        }
//
//    // Cualidad Especial
//        $qb->addSelect('conductorAccidenteCualidadEspecial');
//        $qb->leftJoin('conductorAccidente.cualidadEspecial', 'conductorAccidenteCualidadEspecial');
//
//        $qb->addSelect('pasajerosAccidenteCualidadEspecial');
//        $qb->leftJoin('pasajerosAccidente.cualidadEspecial', 'pasajerosAccidenteCualidadEspecial');
//
//        $qb->addSelect('peatonesAccidenteCualidadEspecial');
//        $qb->leftJoin('peatonesAccidente.cualidadEspecial', 'peatonesAccidenteCualidadEspecial');
//
//        if(array_key_exists('cualidadEspecial', $busqueda) and !$busqueda['cualidadEspecial']->isEmpty()) {
//            $qb->andWhere('conductorAccidenteCualidadEspecial in (:cualidadEspecial) or pasajerosAccidenteCualidadEspecial in (:cualidadEspecial) or peatonesAccidenteCualidadEspecial in (:cualidadEspecial)');
//            $qb->setParameter('cualidadEspecial', $busqueda['cualidadEspecial']);
//        }
//
//    // Tipo Trayecto
//        $qb->addSelect('conductorAccidenteTipoTrayecto');
//        $qb->leftJoin('conductorAccidente.tipoTrayecto', 'conductorAccidenteTipoTrayecto');
//
//        $qb->addSelect('pasajerosAccidenteTipoTrayecto');
//        $qb->leftJoin('pasajerosAccidente.tipoTrayecto', 'pasajerosAccidenteTipoTrayecto');
//
//        $qb->addSelect('peatonesAccidenteTipoTrayecto');
//        $qb->leftJoin('peatonesAccidente.tipoTrayecto', 'peatonesAccidenteTipoTrayecto');
//
//        if(array_key_exists('tipoTrayecto', $busqueda) and !$busqueda['tipoTrayecto']->isEmpty()) {
//            $qb->andWhere('conductorAccidenteTipoTrayecto in (:tipoTrayecto) or pasajerosAccidenteTipoTrayecto in (:tipoTrayecto) or peatonesAccidenteTipoTrayecto in (:tipoTrayecto)');
//            $qb->setParameter('tipoTrayecto', $busqueda['tipoTrayecto']);
//        }
//
//    // Seguridad Persona
//        $qb->addSelect('conductorAccidenteSeguridad');
//        $qb->leftJoin('conductorAccidente.seguridad', 'conductorAccidenteSeguridad');
//
//        $qb->addSelect('pasajerosAccidenteSeguridad');
//        $qb->leftJoin('pasajerosAccidente.seguridad', 'pasajerosAccidenteSeguridad');
//
//        if(array_key_exists('seguridad', $busqueda) and !$busqueda['seguridad']->isEmpty()) {
//            $qb->andWhere('conductorAccidenteSeguridad in (:seguridad) or pasajerosAccidenteSeguridad in (:seguridad)');
//            $qb->setParameter('seguridad', $busqueda['seguridad']);
//        }

        $query = $qb->getQuery();

        return $query;
    }

    public function filtroAccidenteUnidad($busqueda = array())
    {
        $qb = $this->createQueryBuilder('a');

        $qb->select('a');

        $qb->addSelect('incoherencias');
        $qb->leftJoin('a.incoherencias', 'incoherencias');

        $qb->addSelect('registroEtapas');
        $qb->leftJoin('a.registroEtapas', 'registroEtapas');

        $qb->addSelect('estadoAccidente');
        $qb->leftJoin('a.estadoAccidente', 'estadoAccidente');

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

    // Numero Parte
        if(array_key_exists('numeroParte', $busqueda) and $busqueda['numeroParte']) {
            $qb->andWhere('a.numeroParte = :numeroParte');
            $qb->setParameter('numeroParte', $busqueda['numeroParte']);
        }

    // Numero Formulario
        if(array_key_exists('numeroFormulario', $busqueda) and $busqueda['numeroFormulario']) {
            $qb->andWhere('a.numeroFormulario = :numeroFormulario');
            $qb->setParameter('numeroFormulario', $busqueda['numeroFormulario']);
        }

    // Unidad
        $qb->addSelect('unidad');
        $qb->leftJoin('a.unidad', 'unidad');

        if(array_key_exists('unidad', $busqueda) and !$busqueda['unidad']->isEmpty()) {
            $qb->andWhere('unidad in (:unidad)');
            $qb->setParameter('unidad', $busqueda['unidad']);
        }

    // Funcionario
        $qb->addSelect('funcionario');
        $qb->leftJoin('a.funcionario', 'funcionario');

        if(array_key_exists('funcionario', $busqueda) and !$busqueda['funcionario']->isEmpty()) {
            $qb->andWhere('funcionario in (:funcionario)');
            $qb->setParameter('funcionario', $busqueda['funcionario']);
        }

    // Grado Carabinero
        $qb->addSelect('gradoCarabinero');
        $qb->leftJoin('funcionario.gradoCarabinero', 'gradoCarabinero');

    // Es Mensaje
        if(array_key_exists('esMensaje', $busqueda) and $busqueda['esMensaje']) {
            $qb->andWhere('a.esMensaje = TRUE');
        }

    // Concurre SIAT
        if(array_key_exists('concurreSiat', $busqueda) and $busqueda['concurreSiat']) {
            $qb->andWhere('a.concurreSiat = TRUE');
        }

// Territorial

    // Ubicación
        $qb->addSelect('ubicacion');
        $qb->leftJoin('a.ubicacion', 'ubicacion');

    // Cuadrante
        $qb->addSelect('cuadrante');
        $qb->leftJoin('a.cuadrante', 'cuadrante');

        if(array_key_exists('cuadrante', $busqueda) and !$busqueda['cuadrante']->isEmpty()) {
            $qb->andWhere('cuadrante in (:cuadrante)');
            $qb->setParameter('cuadrante', $busqueda['cuadrante']);
        }

    // Comuna
        $qb->addSelect('comuna');
        $qb->leftJoin('a.comuna', 'comuna');

        if(array_key_exists('comuna', $busqueda) and !$busqueda['comuna']->isEmpty()) {
            $qb->andWhere('comuna in (:comuna)');
            $qb->setParameter('comuna', $busqueda['comuna']);
        }

    // Provincia
        $qb->addSelect('provincia');
        $qb->leftJoin('comuna.provincia', 'provincia');

        if(array_key_exists('provincia', $busqueda) and !$busqueda['provincia']->isEmpty()) {
            $qb->andWhere('provincia in (:provincia)');
            $qb->setParameter('provincia', $busqueda['provincia']);
        }

    // Región
        $qb->addSelect('region');
        $qb->leftJoin('provincia.region', 'region');

        if(array_key_exists('region', $busqueda) and !$busqueda['region']->isEmpty()) {
            $qb->andWhere('region in (:region)');
            $qb->setParameter('region', $busqueda['region']);
        }

        $query = $qb->getQuery();

        return $query;
    }

    public function findByUnidad($unidad)
    {
        return $this->createQueryBuilder('a')
            ->select('a, fr, c, ca, ta, pea, va, vac, vap, ia, rea')
            ->leftJoin('a.funcionarioResponsable', 'fr')
            ->leftJoin('a.comuna', 'c')
            ->leftJoin('a.claseAccidente', 'ca')
            ->leftJoin('a.tipoAccidente', 'ta')
            ->leftJoin('a.peatonesAccidente', 'pea')
            ->leftJoin('a.vehiculosAccidente', 'va')
            ->leftJoin('va.conductorAccidente', 'vac')
            ->leftJoin('va.pasajerosAccidente', 'vap')
            ->leftJoin('a.incoherencias', 'ia')
            ->leftJoin('a.registroEtapas', 'rea')
            ->andWhere('a.unidad = :unidad')
            ->andWhere('YEAR(a.creado) = YEAR(now())')
            ->orderBy('a.id', 'DESC')
            ->setParameter('unidad', $unidad)
            ->getQuery()
        ;
    }

    public function findByFuncionarioResponsable($funcionarioResponsable)
    {
        return $this->createQueryBuilder('a')
            ->select('a, fr, c, ca, ta, pea, va, vac, vap, ia, rea')
            ->leftJoin('a.funcionarioResponsable', 'fr')
            ->leftJoin('a.comuna', 'c')
            ->leftJoin('a.claseAccidente', 'ca')
            ->leftJoin('a.tipoAccidente', 'ta')
            ->leftJoin('a.peatonesAccidente', 'pea')
            ->leftJoin('a.vehiculosAccidente', 'va')
            ->leftJoin('va.conductorAccidente', 'vac')
            ->leftJoin('va.pasajerosAccidente', 'vap')
            ->leftJoin('a.incoherencias', 'ia')
            ->leftJoin('a.registroEtapas', 'rea')
            ->andWhere('a.funcionarioResponsable = :funcionarioResponsable')
            ->andWhere('YEAR(a.creado) = YEAR(now())')
            ->orderBy('a.id', 'DESC')
            ->setParameter('funcionarioResponsable', $funcionarioResponsable)
            ->getQuery()
        ;
    }

    public function obtenerNumeroFormulario($unidad)
    {
        $numeroFormulario = $this->createQueryBuilder('a')
            ->select('count(a.id)')
            ->leftJoin('a.unidad', 'au')
            ->andWhere('YEAR(a.creado) = YEAR(now())')
            ->andWhere('a.unidad = :unidad')
            ->andWhere('a.numeroFormulario IS NOT NULL')
            ->setParameter('unidad', $unidad)
            ->getQuery()
            ->getSingleScalarResult()
        ;

        return $numeroFormulario + 1;
    }

    public function getIdentificacion($accidente)
    {
        return $this->createQueryBuilder('a')
            ->select('a, ca, ta, fu, tr, gc')
            ->leftJoin('a.claseAccidente', 'ca')
            ->leftJoin('a.tipoAccidente', 'ta')
            ->leftJoin('a.funcionario', 'fu')
            ->leftJoin('fu.gradoCarabinero', 'gc')
            ->leftJoin('a.tribunal', 'tr')
            ->andWhere('a.id = :id')
            ->setParameter('id', $accidente->getId())
            ->getQuery()
            ->getSingleResult()
        ;
    }

    public function getCausas($accidente)
    {
        return $this->createQueryBuilder('a')
            ->select('a, cb, c')
            ->leftJoin('a.causaBasal', 'cb')
            ->leftJoin('a.causas', 'c')
            ->andWhere('a.id = :id')
            ->setParameter('id', $accidente->getId())
            ->getQuery()
            ->getSingleResult()
        ;
    }

    public function getCondiciones($accidente)
    {
        return $this->createQueryBuilder('a')
            ->select('a, cpc, ea, ela, epc, tl, tpc, dlc, dpc, ec')
            ->leftJoin('a.condicionPavimentoCalzada', 'cpc')
            ->leftJoin('a.estadoAtmosferico', 'ea')
            ->leftJoin('a.estadoLuzArtificial', 'ela')
            ->leftJoin('a.estadoPavimentoCalzada', 'epc')
            ->leftJoin('a.tipoLuminosidad', 'tl')
            ->leftJoin('a.tipoPavimentoCalzada', 'tpc')
            ->leftJoin('a.demarcacionLineaCalzada', 'dlc')
            ->leftJoin('a.demarcacionPrioridadCalzada', 'dpc')
            ->leftJoin('a.elementosCalzada', 'ec')
            ->andWhere('a.id = :id')
            ->setParameter('id', $accidente->getId())
            ->getQuery()
            ->getSingleResult()
        ;
    }

    public function getUbicacion($accidente)
    {
        return $this->createQueryBuilder('a')
            ->select('a, co, cu, tz, tur, td')
            ->leftJoin('a.comuna', 'co')
            ->leftJoin('a.cuadrante', 'cu')
            ->leftJoin('a.tipoZonaAccidente', 'tz')
            ->leftJoin('a.tipoUbicacionRelativaAccidente', 'tur')
            ->leftJoin('a.tipoDireccion', 'td')
            ->andWhere('a.id = :id')
            ->setParameter('id', $accidente->getId())
            ->getQuery()
            ->getSingleResult()
        ;
    }

    public function getVehiculos($accidente)
    {
        return $this->createQueryBuilder('a')
            ->select('a, va, cv, dv, mv, sv, v, tv, coa, coacll, coacol, coacf, coacp, coace, coatt, coas, coap, paa, paacf, paacp, paace, paatt, paas, paap, pea, peacf, peacp, peace, peatt, peap')
            ->leftJoin('a.vehiculosAccidente', 'va')
            ->leftJoin('va.consecuenciaVehiculo', 'cv')
            ->leftJoin('va.direccionVehiculo', 'dv')
            ->leftJoin('va.maniobraVehiculo', 'mv')
            ->leftJoin('va.servicioVehiculo', 'sv')
            ->leftJoin('va.vehiculo', 'v')
            ->leftJoin('v.tipoVehiculo', 'tv')
            ->leftJoin('va.conductorAccidente', 'coa')
            ->leftJoin('coa.claseLicencia', 'coacll')
            ->leftJoin('coa.comunaLicencia', 'coacol')
            ->leftJoin('coa.condicionFisica', 'coacf')
            ->leftJoin('coa.consecuenciaPersona', 'coacp')
            ->leftJoin('coa.cualidadEspecial', 'coace')
            ->leftJoin('coa.tipoTrayecto', 'coatt')
            ->leftJoin('coa.seguridad', 'coas')
            ->leftJoin('coa.persona', 'coap')
            ->leftJoin('va.pasajerosAccidente', 'paa')
            ->leftJoin('paa.condicionFisica', 'paacf')
            ->leftJoin('paa.consecuenciaPersona', 'paacp')
            ->leftJoin('paa.cualidadEspecial', 'paace')
            ->leftJoin('paa.tipoTrayecto', 'paatt')
            ->leftJoin('paa.seguridad', 'paas')
            ->leftJoin('paa.persona', 'paap')
            ->leftJoin('a.peatonesAccidente', 'pea')
            ->leftJoin('pea.condicionFisica', 'peacf')
            ->leftJoin('pea.consecuenciaPersona', 'peacp')
            ->leftJoin('pea.cualidadEspecial', 'peace')
            ->leftJoin('pea.tipoTrayecto', 'peatt')
            ->leftJoin('pea.persona', 'peap')
            ->andWhere('a.id = :id')
            ->setParameter('id', $accidente->getId())
            ->getQuery()
            ->getSingleResult()
        ;
    }

    public function getPeatones($accidente)
    {
        return $this->createQueryBuilder('a')
            ->select('a, pea, peacf, peacp, peace, peatt, peap')
            ->leftJoin('a.peatonesAccidente', 'pea')
            ->leftJoin('pea.condicionFisica', 'peacf')
            ->leftJoin('pea.consecuenciaPersona', 'peacp')
            ->leftJoin('pea.cualidadEspecial', 'peace')
            ->leftJoin('pea.tipoTrayecto', 'peatt')
            ->leftJoin('pea.persona', 'peap')
            ->andWhere('a.id = :id')
            ->setParameter('id', $accidente->getId())
            ->getQuery()
            ->getSingleResult()
        ;
    }

    public function getResumen($accidente)
    {
        return $this->createQueryBuilder('a')
            ->select('a, c, cb, ca, co, cpc, cu, ea, ela, epc, fu, fur, ta, td, tl, tpc, tur, tz, tr, un, dlc, dpc, ec, va, cv, dv, mv, sv, v, tv, coa, coacll, coacol, coacf, coacp, coace, coatt, coap, paa, paacf, paacp, paace, paatt, paap, pea, peacf, peacp, peace, peatt, peap')
            ->leftJoin('a.causas', 'c')
            ->leftJoin('a.causaBasal', 'cb')
            ->leftJoin('a.claseAccidente', 'ca')
            ->leftJoin('a.comuna', 'co')
            ->leftJoin('a.condicionPavimentoCalzada', 'cpc')
            ->leftJoin('a.cuadrante', 'cu')
            ->leftJoin('a.estadoAtmosferico', 'ea')
            ->leftJoin('a.estadoLuzArtificial', 'ela')
            ->leftJoin('a.estadoPavimentoCalzada', 'epc')
            ->leftJoin('a.funcionario', 'fu')
            ->leftJoin('a.funcionarioResponsable', 'fur')
            ->leftJoin('a.tipoAccidente', 'ta')
            ->leftJoin('a.tipoDireccion', 'td')
            ->leftJoin('a.tipoLuminosidad', 'tl')
            ->leftJoin('a.tipoPavimentoCalzada', 'tpc')
            ->leftJoin('a.tipoUbicacionRelativaAccidente', 'tur')
            ->leftJoin('a.tipoZonaAccidente', 'tz')
            ->leftJoin('a.tribunal', 'tr')
            ->leftJoin('a.unidad', 'un')
            ->leftJoin('a.demarcacionLineaCalzada', 'dlc')
            ->leftJoin('a.demarcacionPrioridadCalzada', 'dpc')
            ->leftJoin('a.elementosCalzada', 'ec')
// vehiculos
            ->leftJoin('a.vehiculosAccidente', 'va')
            ->leftJoin('va.consecuenciaVehiculo', 'cv')
            ->leftJoin('va.direccionVehiculo', 'dv')
            ->leftJoin('va.maniobraVehiculo', 'mv')
            ->leftJoin('va.servicioVehiculo', 'sv')
            ->leftJoin('va.vehiculo', 'v')
            ->leftJoin('v.tipoVehiculo', 'tv')
// conductor
            ->leftJoin('va.conductorAccidente', 'coa')
            ->leftJoin('coa.claseLicencia', 'coacll')
            ->leftJoin('coa.comunaLicencia', 'coacol')
            ->leftJoin('coa.condicionFisica', 'coacf')
            ->leftJoin('coa.consecuenciaPersona', 'coacp')
            ->leftJoin('coa.cualidadEspecial', 'coace')
            ->leftJoin('coa.tipoTrayecto', 'coatt')
            ->leftJoin('coa.persona', 'coap')
// pasajeros
            ->leftJoin('va.pasajerosAccidente', 'paa')
            ->leftJoin('paa.condicionFisica', 'paacf')
            ->leftJoin('paa.consecuenciaPersona', 'paacp')
            ->leftJoin('paa.cualidadEspecial', 'paace')
            ->leftJoin('paa.tipoTrayecto', 'paatt')
            ->leftJoin('paa.persona', 'paap')
// personas
            ->leftJoin('a.peatonesAccidente', 'pea')
            ->leftJoin('pea.condicionFisica', 'peacf')
            ->leftJoin('pea.consecuenciaPersona', 'peacp')
            ->leftJoin('pea.cualidadEspecial', 'peace')
            ->leftJoin('pea.tipoTrayecto', 'peatt')
            ->leftJoin('pea.persona', 'peap')

            ->andWhere('a.id = :id')
            ->setParameter('id', $accidente->getId())
            ->getQuery()
            ->getSingleResult()
        ;
    }

    public function getTipoAccidenteUnidad($unidad)
    {
        return $this->createQueryBuilder('a')
            ->select('ta.nombre, count(a) as conteo')
            ->leftJoin('a.tipoAccidente', 'ta')
            ->groupby('ta.id')
            ->andWhere('a.unidad = :unidad')
            ->setParameter('unidad', $unidad)
            ->getQuery()
            ->getResult()
        ;
    }

    public function exportar()
    {
        return $this->createQueryBuilder('a')
            ->select('a, c, cb, ca, co, cpc, cu, ea, ela, epc, fu, fur, ta, td, tl, tpc, tur, tz, tr, un, dlc, dpc, ec, va, cv, dv, mv, sv, v, tv, coa, coacll, coacol, coacf, coacp, coace, coatt, coap, paa, paacf, paacp, paace, paatt, paap, pea, peacf, peacp, peace, peatt, peap')
            ->leftJoin('a.causas', 'c')
            ->leftJoin('a.causaBasal', 'cb')
            ->leftJoin('a.claseAccidente', 'ca')
            ->leftJoin('a.comuna', 'co')
            ->leftJoin('a.condicionPavimentoCalzada', 'cpc')
            ->leftJoin('a.cuadrante', 'cu')
            ->leftJoin('a.estadoAtmosferico', 'ea')
            ->leftJoin('a.estadoLuzArtificial', 'ela')
            ->leftJoin('a.estadoPavimentoCalzada', 'epc')
            ->leftJoin('a.funcionario', 'fu')
            ->leftJoin('a.funcionarioResponsable', 'fur')
            ->leftJoin('a.tipoAccidente', 'ta')
            ->leftJoin('a.tipoDireccion', 'td')
            ->leftJoin('a.tipoLuminosidad', 'tl')
            ->leftJoin('a.tipoPavimentoCalzada', 'tpc')
            ->leftJoin('a.tipoUbicacionRelativaAccidente', 'tur')
            ->leftJoin('a.tipoZonaAccidente', 'tz')
            ->leftJoin('a.tribunal', 'tr')
            ->leftJoin('a.unidad', 'un')
            ->leftJoin('a.demarcacionLineaCalzada', 'dlc')
            ->leftJoin('a.demarcacionPrioridadCalzada', 'dpc')
            ->leftJoin('a.elementosCalzada', 'ec')
            ->getQuery()
            ->getResult()
        ;
    }
}
