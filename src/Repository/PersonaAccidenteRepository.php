<?php

namespace App\Repository;

use App\Entity\PersonaAccidente;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PersonaAccidente|null find($id, $lockMode = null, $lockVersion = null)
 * @method PersonaAccidente|null findOneBy(array $criteria, array $orderBy = null)
 * @method PersonaAccidente[]    findAll()
 * @method PersonaAccidente[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonaAccidenteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PersonaAccidente::class);
    }

    public function findInspeccionPersonas($busqueda)
    {
        $qb = $this->createQueryBuilder('personaAccidente');

        $qb->select('personaAccidente');

// Personal
        $qb->addSelect('persona');
        $qb->leftJoin('personaAccidente.persona', 'persona');

    // Condición física
        $qb->addSelect('personaAccidenteCondicionFisica');
        $qb->leftJoin('personaAccidente.condicionFisica', 'personaAccidenteCondicionFisica');

        if(array_key_exists('condicionFisica', $busqueda) and !$busqueda['condicionFisica']->isEmpty()) {
            $qb->andWhere('personaAccidenteCondicionFisica in (:condicionFisica)');
            $qb->setParameter('condicionFisica', $busqueda['condicionFisica']);
        }

    // Consecuencia Persona
        $qb->addSelect('personaAccidenteConsecuenciaPersona');
        $qb->leftJoin('personaAccidente.consecuenciaPersona', 'personaAccidenteConsecuenciaPersona');

        if(array_key_exists('consecuenciaPersona', $busqueda) and !$busqueda['consecuenciaPersona']->isEmpty()) {
            $qb->andWhere('personaAccidenteConsecuenciaPersona in (:consecuenciaPersona)');
            $qb->setParameter('consecuenciaPersona', $busqueda['consecuenciaPersona']);
        }

    // Cualidad Especial
        $qb->addSelect('personaAccidenteCualidadEspecial');
        $qb->leftJoin('personaAccidente.cualidadEspecial', 'personaAccidenteCualidadEspecial');

        if(array_key_exists('cualidadEspecial', $busqueda) and !$busqueda['cualidadEspecial']->isEmpty()) {
            $qb->andWhere('personaAccidenteCualidadEspecial in (:cualidadEspecial)');
            $qb->setParameter('cualidadEspecial', $busqueda['cualidadEspecial']);
        }

    // Tipo Trayecto
        $qb->addSelect('personaAccidenteTipoTrayecto');
        $qb->leftJoin('personaAccidente.tipoTrayecto', 'personaAccidenteTipoTrayecto');

        if(array_key_exists('tipoTrayecto', $busqueda) and !$busqueda['tipoTrayecto']->isEmpty()) {
            $qb->andWhere('personaAccidenteTipoTrayecto in (:tipoTrayecto)');
            $qb->setParameter('tipoTrayecto', $busqueda['tipoTrayecto']);
        }

    // Seguridad
        $qb->addSelect('personaAccidenteSeguridad');
        $qb->leftJoin('personaAccidente.seguridad', 'personaAccidenteSeguridad');

        if(array_key_exists('seguridad', $busqueda) and !$busqueda['seguridad']->isEmpty()) {
            $qb->andWhere('personaAccidenteSeguridad in (:seguridad)');
            $qb->setParameter('seguridad', $busqueda['seguridad']);
        }

    // Clase Licencia
        $qb->addSelect('personaAccidenteClaseLicencia');
        $qb->leftJoin('personaAccidente.claseLicencia', 'personaAccidenteClaseLicencia');

        if(array_key_exists('claseLicencia', $busqueda) and !$busqueda['claseLicencia']->isEmpty()) {
            $qb->andWhere('personaAccidenteClaseLicencia in (:claseLicencia)');
            $qb->setParameter('claseLicencia', $busqueda['claseLicencia']);
        }

    // Comuna Licencia
        $qb->addSelect('personaAccidenteComunaLicencia');
        $qb->leftJoin('personaAccidente.comunaLicencia', 'personaAccidenteComunaLicencia');

        if(array_key_exists('comunaLicencia', $busqueda) and !$busqueda['comunaLicencia']->isEmpty()) {
            $qb->andWhere('personaAccidenteComunaLicencia in (:comunaLicencia)');
            $qb->setParameter('comunaLicencia', $busqueda['comunaLicencia']);
        }

// Vehicular
        $qb->addSelect('vehiculoPasajero');
        $qb->leftJoin('personaAccidente.vehiculoAccidente', 'vehiculoPasajero');

        $qb->addSelect('vehiculoConductor');
        $qb->leftJoin('personaAccidente.vehiculoConducidoAccidente', 'vehiculoConductor');

    // Tipo Vehículo
        $qb->addSelect('vehiculoPasajeroVehiculo');
        $qb->leftJoin('vehiculoPasajero.vehiculo', 'vehiculoPasajeroVehiculo');

        $qb->addSelect('vehiculoConductorVehiculo');
        $qb->leftJoin('vehiculoConductor.vehiculo', 'vehiculoConductorVehiculo');

        $qb->addSelect('vehiculoPasajeroTipoVehiculo');
        $qb->leftJoin('vehiculoPasajeroVehiculo.tipoVehiculo', 'vehiculoPasajeroTipoVehiculo');

        $qb->addSelect('vehiculoConductorTipoVehiculo');
        $qb->leftJoin('vehiculoConductorVehiculo.tipoVehiculo', 'vehiculoConductorTipoVehiculo');

        if(array_key_exists('tipoVehiculo', $busqueda) and !$busqueda['tipoVehiculo']->isEmpty()) {
            $qb->andWhere('vehiculoPasajeroTipoVehiculo in (:tipoVehiculo) or vehiculoConductorTipoVehiculo in (:tipoVehiculo)');
            $qb->setParameter('tipoVehiculo', $busqueda['tipoVehiculo']);
        }

    // Servicio Vehículo
        $qb->addSelect('vehiculoPasajeroServicioVehiculo');
        $qb->leftJoin('vehiculoPasajero.servicioVehiculo', 'vehiculoPasajeroServicioVehiculo');

        $qb->addSelect('vehiculoConductorServicioVehiculo');
        $qb->leftJoin('vehiculoConductor.servicioVehiculo', 'vehiculoConductorServicioVehiculo');

        if(array_key_exists('servicioVehiculo', $busqueda) and !$busqueda['servicioVehiculo']->isEmpty()) {
            $qb->andWhere('vehiculoPasajeroServicioVehiculo in (:servicioVehiculo) or vehiculoConductorServicioVehiculo in (:servicioVehiculo)');
            $qb->setParameter('servicioVehiculo', $busqueda['servicioVehiculo']);
        }

    // Maniobra Vehículo
        $qb->addSelect('vehiculoPasajeroManiobraVehiculo');
        $qb->leftJoin('vehiculoPasajero.maniobraVehiculo', 'vehiculoPasajeroManiobraVehiculo');

        $qb->addSelect('vehiculoConductorManiobraVehiculo');
        $qb->leftJoin('vehiculoConductor.maniobraVehiculo', 'vehiculoConductorManiobraVehiculo');

        if(array_key_exists('maniobraVehiculo', $busqueda) and !$busqueda['maniobraVehiculo']->isEmpty()) {
            $qb->andWhere('vehiculoPasajeroManiobraVehiculo in (:maniobraVehiculo) or vehiculoConductorManiobraVehiculo in (:maniobraVehiculo)');
            $qb->setParameter('maniobraVehiculo', $busqueda['maniobraVehiculo']);
        }

    // Dirección Vehículo
        $qb->addSelect('vehiculoPasajeroDireccionVehiculo');
        $qb->leftJoin('vehiculoPasajero.direccionVehiculo', 'vehiculoPasajeroDireccionVehiculo');

        $qb->addSelect('vehiculoConductorDireccionVehiculo');
        $qb->leftJoin('vehiculoConductor.direccionVehiculo', 'vehiculoConductorDireccionVehiculo');

        if(array_key_exists('direccionVehiculo', $busqueda) and !$busqueda['direccionVehiculo']->isEmpty()) {
            $qb->andWhere('vehiculoPasajeroDireccionVehiculo in (:direccionVehiculo) or vehiculoConductorDireccionVehiculo in (:direccionVehiculo)');
            $qb->setParameter('direccionVehiculo', $busqueda['direccionVehiculo']);
        }

    // Consecuencia Vehículo
        $qb->addSelect('vehiculoPasajeroConsecuenciaVehiculo');
        $qb->leftJoin('vehiculoPasajero.consecuenciaVehiculo', 'vehiculoPasajeroConsecuenciaVehiculo');

        $qb->addSelect('vehiculoConductorConsecuenciaVehiculo');
        $qb->leftJoin('vehiculoConductor.consecuenciaVehiculo', 'vehiculoConductorConsecuenciaVehiculo');

        if(array_key_exists('consecuenciaVehiculo', $busqueda) and !$busqueda['consecuenciaVehiculo']->isEmpty()) {
            $qb->andWhere('vehiculoPasajeroConsecuenciaVehiculo in (:consecuenciaVehiculo) or vehiculoConductorConsecuenciaVehiculo in (:consecuenciaVehiculo)');
            $qb->setParameter('consecuenciaVehiculo', $busqueda['consecuenciaVehiculo']);
        }


// Accidental Cualitativa
        $qb->addSelect('accidentePeaton');
        $qb->leftJoin('personaAccidente.accidente', 'accidentePeaton');

        $qb->addSelect('accidentePasajero');
        $qb->leftJoin('vehiculoPasajero.accidente', 'accidentePasajero');

        $qb->addSelect('accidenteConductor');
        $qb->leftJoin('vehiculoConductor.accidente', 'accidenteConductor');


    // Comuna
        $qb->addSelect('accidentePeatonComuna');
        $qb->leftJoin('accidentePeaton.comuna', 'accidentePeatonComuna');

        $qb->addSelect('accidentePasajeroComuna');
        $qb->leftJoin('accidentePasajero.comuna', 'accidentePasajeroComuna');

        $qb->addSelect('accidenteConductorComuna');
        $qb->leftJoin('accidenteConductor.comuna', 'accidenteConductorComuna');

        if(array_key_exists('comuna', $busqueda) and !$busqueda['comuna']->isEmpty()) {
            $qb->andWhere('accidentePeatonComuna in (:comuna) or accidentePasajeroComuna in (:comuna) or accidenteConductorComuna in (:comuna)');
            $qb->setParameter('comuna', $busqueda['comuna']);
        }

    // Provincia
        $qb->addSelect('accidentePeatonProvincia');
        $qb->leftJoin('accidentePeatonComuna.provincia', 'accidentePeatonProvincia');

        $qb->addSelect('accidentePasajeroProvincia');
        $qb->leftJoin('accidentePasajeroComuna.provincia', 'accidentePasajeroProvincia');

        $qb->addSelect('accidenteConductorProvincia');
        $qb->leftJoin('accidenteConductorComuna.provincia', 'accidenteConductorProvincia');

        if(array_key_exists('provincia', $busqueda) and !$busqueda['provincia']->isEmpty()) {
            $qb->andWhere('accidentePeatonProvincia in (:provincia) or accidentePasajeroProvincia in (:provincia) or accidenteConductorProvincia in (:provincia)');
            $qb->setParameter('provincia', $busqueda['provincia']);
        }

    // Región
        $qb->addSelect('accidentePeatonRegion');
        $qb->leftJoin('accidentePeatonProvincia.region', 'accidentePeatonRegion');

        $qb->addSelect('accidentePasajeroRegion');
        $qb->leftJoin('accidentePasajeroProvincia.region', 'accidentePasajeroRegion');

        $qb->addSelect('accidenteConductorRegion');
        $qb->leftJoin('accidenteConductorProvincia.region', 'accidenteConductorRegion');

        if(array_key_exists('region', $busqueda) and !$busqueda['region']->isEmpty()) {
            $qb->andWhere('accidentePeatonRegion in (:region) or accidentePasajeroRegion in (:region) or accidenteConductorRegion in (:region)');
            $qb->setParameter('region', $busqueda['region']);
        }



    // Clase Accidente
        $qb->addSelect('accidentePeatonClaseAccidente');
        $qb->leftJoin('accidentePeaton.claseAccidente', 'accidentePeatonClaseAccidente');

        $qb->addSelect('accidentePasajeroClaseAccidente');
        $qb->leftJoin('accidentePasajero.claseAccidente', 'accidentePasajeroClaseAccidente');

        $qb->addSelect('accidenteConductorClaseAccidente');
        $qb->leftJoin('accidenteConductor.claseAccidente', 'accidenteConductorClaseAccidente');

        if(array_key_exists('claseAccidente', $busqueda) and !$busqueda['claseAccidente']->isEmpty()) {
            $qb->andWhere('accidentePeatonClaseAccidente in (:claseAccidente) or accidentePasajeroClaseAccidente in (:claseAccidente) or accidenteConductorClaseAccidente in (:claseAccidente)');
            $qb->setParameter('claseAccidente', $busqueda['claseAccidente']);
        }

    // Tipo Accidente
        $qb->addSelect('accidentePeatonTipoAccidente');
        $qb->leftJoin('accidentePeaton.tipoAccidente', 'accidentePeatonTipoAccidente');

        $qb->addSelect('accidentePasajeroTipoAccidente');
        $qb->leftJoin('accidentePasajero.tipoAccidente', 'accidentePasajeroTipoAccidente');

        $qb->addSelect('accidenteConductorTipoAccidente');
        $qb->leftJoin('accidenteConductor.tipoAccidente', 'accidenteConductorTipoAccidente');

        if(array_key_exists('tipoAccidente', $busqueda) and !$busqueda['tipoAccidente']->isEmpty()) {
            $qb->andWhere('accidentePeatonTipoAccidente in (:tipoAccidente) or accidentePasajeroTipoAccidente in (:tipoAccidente) or accidenteConductorTipoAccidente in (:tipoAccidente)');
            $qb->setParameter('tipoAccidente', $busqueda['tipoAccidente']);
        }

    // Causa Basal
        $qb->addSelect('accidentePeatonCausaBasal');
        $qb->leftJoin('accidentePeaton.causaBasal', 'accidentePeatonCausaBasal');

        $qb->addSelect('accidentePasajeroCausaBasal');
        $qb->leftJoin('accidentePasajero.causaBasal', 'accidentePasajeroCausaBasal');

        $qb->addSelect('accidenteConductorCausaBasal');
        $qb->leftJoin('accidenteConductor.causaBasal', 'accidenteConductorCausaBasal');

        if(array_key_exists('causaBasal', $busqueda) and !$busqueda['causaBasal']->isEmpty()) {
            $qb->andWhere('accidentePeatonCausaBasal in (:causaBasal) or accidentePasajeroCausaBasal in (:causaBasal) or accidenteConductorCausaBasal in (:causaBasal)');
            $qb->setParameter('causaBasal', $busqueda['causaBasal']);
        }

    // Causas Concurrentes
        $qb->addSelect('accidentePeatonCausasConcurrentes');
        $qb->leftJoin('accidentePeaton.causas', 'accidentePeatonCausasConcurrentes');

        $qb->addSelect('accidentePasajeroCausasConcurrentes');
        $qb->leftJoin('accidentePasajero.causas', 'accidentePasajeroCausasConcurrentes');

        $qb->addSelect('accidenteConductorCausasConcurrentes');
        $qb->leftJoin('accidenteConductor.causas', 'accidenteConductorCausasConcurrentes');

        if(array_key_exists('causas', $busqueda) and !$busqueda['causas']->isEmpty()) {
            $qb->andWhere('accidentePeatonCausasConcurrentes in (:causas) or accidentePasajeroCausasConcurrentes in (:causas) or accidenteConductorCausasConcurrentes in (:causas)');
            $qb->setParameter('causas', $busqueda['causas']);
        }

//    // Estado Accidente
//        $qb->addSelect('accidentePeatonEstadoAccidente');
//        $qb->leftJoin('accidentePeaton.estadoAccidente', 'accidentePeatonEstadoAccidente');
//
//        $qb->addSelect('accidentePasajeroEstadoAccidente');
//        $qb->leftJoin('accidentePasajero.estadoAccidente', 'accidentePasajeroEstadoAccidente');
//
//        $qb->addSelect('accidenteConductorEstadoAccidente');
//        $qb->leftJoin('accidenteConductor.estadoAccidente', 'accidenteConductorEstadoAccidente');
//
//        if(array_key_exists('estadoAccidente', $busqueda) and !$busqueda['estadoAccidente']->isEmpty()) {
//            $qb->andWhere('accidentePeatonEstadoAccidente in (:estadoAccidente) or accidentePasajeroEstadoAccidente in (:estadoAccidente) or accidenteConductorEstadoAccidente in (:estadoAccidente)');
//            $qb->setParameter('estadoAccidente', $busqueda['estadoAccidente']);
//        }
//
//    // Tipo Causa
//        $qb->addSelect('accidentePeatonTipoCausa');
//        $qb->leftJoin('accidentePeatonCausaBasal.tipoCausa', 'accidentePeatonTipoCausa');
//
//        $qb->addSelect('accidentePasajeroTipoCausa');
//        $qb->leftJoin('accidentePasajeroCausaBasal.tipoCausa', 'accidentePasajeroTipoCausa');
//
//        $qb->addSelect('accidenteConductorTipoCausa');
//        $qb->leftJoin('accidenteConductorCausaBasal.tipoCausa', 'accidenteConductorTipoCausa');
//
//        if(array_key_exists('tipoCausa', $busqueda) and !$busqueda['tipoCausa']->isEmpty()) {
//            $qb->andWhere('accidentePeatonTipoCausa in (:tipoCausa) or accidentePasajeroTipoCausa in (:tipoCausa) or accidenteConductorTipoCausa in (:tipoCausa)');
//            $qb->setParameter('tipoCausa', $busqueda['tipoCausa']);
//        }
//
//    // Estado Atmosférico
//        $qb->addSelect('accidentePeatonEstadoAtmosferico');
//        $qb->leftJoin('accidentePeaton.estadoAtmosferico', 'accidentePeatonEstadoAtmosferico');
//
//        $qb->addSelect('accidentePasajeroEstadoAtmosferico');
//        $qb->leftJoin('accidentePasajero.estadoAtmosferico', 'accidentePasajeroEstadoAtmosferico');
//
//        $qb->addSelect('accidenteConductorEstadoAtmosferico');
//        $qb->leftJoin('accidenteConductor.estadoAtmosferico', 'accidenteConductorEstadoAtmosferico');
//
//        if(array_key_exists('estadoAtmosferico', $busqueda) and !$busqueda['estadoAtmosferico']->isEmpty()) {
//            $qb->andWhere('accidentePeatonEstadoAtmosferico in (:estadoAtmosferico) or accidentePasajeroEstadoAtmosferico in (:estadoAtmosferico) or accidenteConductorEstadoAtmosferico in (:estadoAtmosferico)');
//            $qb->setParameter('estadoAtmosferico', $busqueda['estadoAtmosferico']);
//        }
//
//    // Tipo Luminosidad
//        $qb->addSelect('accidentePeatonTipoLuminosidad');
//        $qb->leftJoin('accidentePeaton.tipoLuminosidad', 'accidentePeatonTipoLuminosidad');
//
//        $qb->addSelect('accidentePasajeroTipoLuminosidad');
//        $qb->leftJoin('accidentePasajero.tipoLuminosidad', 'accidentePasajeroTipoLuminosidad');
//
//        $qb->addSelect('accidenteConductorTipoLuminosidad');
//        $qb->leftJoin('accidenteConductor.tipoLuminosidad', 'accidenteConductorTipoLuminosidad');
//
//        if(array_key_exists('tipoLuminosidad', $busqueda) and !$busqueda['tipoLuminosidad']->isEmpty()) {
//            $qb->andWhere('accidentePeatonTipoLuminosidad in (:tipoLuminosidad) or accidentePasajeroTipoLuminosidad in (:tipoLuminosidad) or accidenteConductorTipoLuminosidad in (:tipoLuminosidad)');
//            $qb->setParameter('tipoLuminosidad', $busqueda['tipoLuminosidad']);
//        }
//
//    // Luz Artificial
//        $qb->addSelect('accidentePeatonLuzArtificial');
//        $qb->leftJoin('accidentePeaton.estadoLuzArtificial', 'accidentePeatonLuzArtificial');
//
//        $qb->addSelect('accidentePasajeroLuzArtificial');
//        $qb->leftJoin('accidentePasajero.estadoLuzArtificial', 'accidentePasajeroLuzArtificial');
//
//        $qb->addSelect('accidenteConductorLuzArtificial');
//        $qb->leftJoin('accidenteConductor.estadoLuzArtificial', 'accidenteConductorLuzArtificial');
//
//        if(array_key_exists('estadoLuzArtificial', $busqueda) and !$busqueda['estadoLuzArtificial']->isEmpty()) {
//            $qb->andWhere('accidentePeatonLuzArtificial in (:estadoLuzArtificial) or accidentePasajeroLuzArtificial in (:estadoLuzArtificial) or accidenteConductorLuzArtificial in (:estadoLuzArtificial)');
//            $qb->setParameter('estadoLuzArtificial', $busqueda['estadoLuzArtificial']);
//        }
//
//    // Tipo Pavimento Calzada
//        $qb->addSelect('accidentePeatonTipoPavimentoCalzada');
//        $qb->leftJoin('accidentePeaton.tipoPavimentoCalzada', 'accidentePeatonTipoPavimentoCalzada');
//
//        $qb->addSelect('accidentePasajeroTipoPavimentoCalzada');
//        $qb->leftJoin('accidentePasajero.tipoPavimentoCalzada', 'accidentePasajeroTipoPavimentoCalzada');
//
//        $qb->addSelect('accidenteConductorTipoPavimentoCalzada');
//        $qb->leftJoin('accidenteConductor.tipoPavimentoCalzada', 'accidenteConductorTipoPavimentoCalzada');
//
//        if(array_key_exists('tipoPavimentoCalzada', $busqueda) and !$busqueda['tipoPavimentoCalzada']->isEmpty()) {
//            $qb->andWhere('accidentePeatonTipoPavimentoCalzada in (:tipoPavimentoCalzada) or accidentePasajeroTipoPavimentoCalzada in (:tipoPavimentoCalzada) or accidenteConductorTipoPavimentoCalzada in (:tipoPavimentoCalzada)');
//            $qb->setParameter('tipoPavimentoCalzada', $busqueda['tipoPavimentoCalzada']);
//        }
//
//    // Condición Pavimento Calzada
//        $qb->addSelect('accidentePeatonCondicionPavimentoCalzada');
//        $qb->leftJoin('accidentePeaton.condicionPavimentoCalzada', 'accidentePeatonCondicionPavimentoCalzada');
//
//        $qb->addSelect('accidentePasajeroCondicionPavimentoCalzada');
//        $qb->leftJoin('accidentePasajero.condicionPavimentoCalzada', 'accidentePasajeroCondicionPavimentoCalzada');
//
//        $qb->addSelect('accidenteConductorCondicionPavimentoCalzada');
//        $qb->leftJoin('accidenteConductor.condicionPavimentoCalzada', 'accidenteConductorCondicionPavimentoCalzada');
//
//        if(array_key_exists('condicionPavimentoCalzada', $busqueda) and !$busqueda['condicionPavimentoCalzada']->isEmpty()) {
//            $qb->andWhere('accidentePeatonCondicionPavimentoCalzada in (:condicionPavimentoCalzada) or accidentePasajeroCondicionPavimentoCalzada in (:condicionPavimentoCalzada) or accidenteConductorCondicionPavimentoCalzada in (:condicionPavimentoCalzada)');
//            $qb->setParameter('condicionPavimentoCalzada', $busqueda['condicionPavimentoCalzada']);
//        }
//
//    // Estado Pavimento Calzada
//        $qb->addSelect('accidentePeatonEstadoPavimentoCalzada');
//        $qb->leftJoin('accidentePeaton.estadoPavimentoCalzada', 'accidentePeatonEstadoPavimentoCalzada');
//
//        $qb->addSelect('accidentePasajeroEstadoPavimentoCalzada');
//        $qb->leftJoin('accidentePasajero.estadoPavimentoCalzada', 'accidentePasajeroEstadoPavimentoCalzada');
//
//        $qb->addSelect('accidenteConductorEstadoPavimentoCalzada');
//        $qb->leftJoin('accidenteConductor.estadoPavimentoCalzada', 'accidenteConductorEstadoPavimentoCalzada');
//
//        if(array_key_exists('estadoPavimentoCalzada', $busqueda) and !$busqueda['estadoPavimentoCalzada']->isEmpty()) {
//            $qb->andWhere('accidentePeatonEstadoPavimentoCalzada in (:estadoPavimentoCalzada) or accidentePasajeroEstadoPavimentoCalzada in (:estadoPavimentoCalzada) or accidenteConductorEstadoPavimentoCalzada in (:estadoPavimentoCalzada)');
//            $qb->setParameter('estadoPavimentoCalzada', $busqueda['estadoPavimentoCalzada']);
//        }
//
//    // Tipo Calzada
//        $qb->addSelect('accidentePeatonTipoCalzada');
//        $qb->leftJoin('accidentePeaton.tipoCalzada', 'accidentePeatonTipoCalzada');
//
//        $qb->addSelect('accidentePasajeroTipoCalzada');
//        $qb->leftJoin('accidentePasajero.tipoCalzada', 'accidentePasajeroTipoCalzada');
//
//        $qb->addSelect('accidenteConductorTipoCalzada');
//        $qb->leftJoin('accidenteConductor.tipoCalzada', 'accidenteConductorTipoCalzada');
//
//        if(array_key_exists('tipoCalzada', $busqueda) and !$busqueda['tipoCalzada']->isEmpty()) {
//            $qb->andWhere('accidentePeatonTipoCalzada in (:tipoCalzada) or accidentePasajeroTipoCalzada in (:tipoCalzada) or accidenteConductorTipoCalzada in (:tipoCalzada)');
//            $qb->setParameter('tipoCalzada', $busqueda['tipoCalzada']);
//        }
//
//    // Demarcación Línea Calzada
//        $qb->addSelect('accidentePeatonDemarcacionLineaCalzada');
//        $qb->leftJoin('accidentePeaton.demarcacionLineaCalzada', 'accidentePeatonDemarcacionLineaCalzada');
//
//        $qb->addSelect('accidentePasajeroDemarcacionLineaCalzada');
//        $qb->leftJoin('accidentePasajero.demarcacionLineaCalzada', 'accidentePasajeroDemarcacionLineaCalzada');
//
//        $qb->addSelect('accidenteConductorDemarcacionLineaCalzada');
//        $qb->leftJoin('accidenteConductor.demarcacionLineaCalzada', 'accidenteConductorDemarcacionLineaCalzada');
//
//        if(array_key_exists('demarcacionLineaCalzada', $busqueda) and !$busqueda['demarcacionLineaCalzada']->isEmpty()) {
//            $qb->andWhere('accidentePeatonDemarcacionLineaCalzada in (:demarcacionLineaCalzada) or accidentePasajeroDemarcacionLineaCalzada in (:demarcacionLineaCalzada) or accidenteConductorDemarcacionLineaCalzada in (:demarcacionLineaCalzada)');
//            $qb->setParameter('demarcacionLineaCalzada', $busqueda['demarcacionLineaCalzada']);
//        }
//
//    // Demarcación Prioridad Calzada
//        $qb->addSelect('accidentePeatonDemarcacionPrioridadCalzada');
//        $qb->leftJoin('accidentePeaton.demarcacionPrioridadCalzada', 'accidentePeatonDemarcacionPrioridadCalzada');
//
//        $qb->addSelect('accidentePasajeroDemarcacionPrioridadCalzada');
//        $qb->leftJoin('accidentePasajero.demarcacionPrioridadCalzada', 'accidentePasajeroDemarcacionPrioridadCalzada');
//
//        $qb->addSelect('accidenteConductorDemarcacionPrioridadCalzada');
//        $qb->leftJoin('accidenteConductor.demarcacionPrioridadCalzada', 'accidenteConductorDemarcacionPrioridadCalzada');
//
//        if(array_key_exists('demarcacionPrioridadCalzada', $busqueda) and !$busqueda['demarcacionPrioridadCalzada']->isEmpty()) {
//            $qb->andWhere('accidentePeatonDemarcacionPrioridadCalzada in (:demarcacionPrioridadCalzada) or accidentePasajeroDemarcacionPrioridadCalzada in (:demarcacionPrioridadCalzada) or accidenteConductorDemarcacionPrioridadCalzada in (:demarcacionPrioridadCalzada)');
//            $qb->setParameter('demarcacionPrioridadCalzada', $busqueda['demarcacionPrioridadCalzada']);
//        }
//
//    // Elementos Calzada
//        $qb->addSelect('accidentePeatonElementoCalzada');
//        $qb->leftJoin('accidentePeaton.elementosCalzada', 'accidentePeatonElementoCalzada');
//
//        $qb->addSelect('accidentePasajeroElementoCalzada');
//        $qb->leftJoin('accidentePasajero.elementosCalzada', 'accidentePasajeroElementoCalzada');
//
//        $qb->addSelect('accidenteConductorElementoCalzada');
//        $qb->leftJoin('accidenteConductor.elementosCalzada', 'accidenteConductorElementoCalzada');
//
//        if(array_key_exists('elementoCalzada', $busqueda) and !$busqueda['elementoCalzada']->isEmpty()) {
//            $qb->andWhere('accidentePeatonElementoCalzada in (:elementoCalzada) or accidentePasajeroElementoCalzada in (:elementoCalzada) or accidenteConductorElementoCalzada in (:elementoCalzada)');
//            $qb->setParameter('elementoCalzada', $busqueda['elementoCalzada']);
//        }
//



        $query = $qb->getQuery();

        return $query;
    }

}
