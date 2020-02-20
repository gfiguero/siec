<?php

namespace App\Form;

use App\Entity\Region;
use App\Entity\Provincia;
use App\Entity\Comuna;
use App\Entity\Cuadrante;
use App\Entity\TipoDireccion;
use App\Entity\TipoUbicacionRelativaAccidente;
use App\Entity\TipoZonaAccidente;

use App\Entity\Unidad;
use App\Entity\Funcionario;
use App\Entity\Tribunal;

use App\Entity\EstadoAccidente;
use App\Entity\ClaseAccidente;
use App\Entity\TipoAccidente;
use App\Entity\TipoCausa;
use App\Entity\Causa;
use App\Entity\EstadoAtmosferico;
use App\Entity\TipoLuminosidad;
use App\Entity\EstadoLuzArtificial;
use App\Entity\TipoPavimentoCalzada;
use App\Entity\CondicionPavimentoCalzada;
use App\Entity\EstadoPavimentoCalzada;
use App\Entity\TipoCalzada;
use App\Entity\DemarcacionLineaCalzada;
use App\Entity\DemarcacionPrioridadCalzada;
use App\Entity\ElementoCalzada;

use App\Entity\TipoVehiculo;
use App\Entity\ServicioVehiculo;
use App\Entity\ManiobraVehiculo;
use App\Entity\DireccionVehiculo;
use App\Entity\ConsecuenciaVehiculo;

use App\Entity\ClaseLicencia;
use App\Entity\CualidadEspecial;
use App\Entity\TipoTrayecto;
use App\Entity\ConsecuenciaPersona;
use App\Entity\CondicionFisica;
use App\Entity\SeguridadPersona;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class FiltroInspeccionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('idMin', IntegerType::class, ['required' => false,])
            ->add('idMax', IntegerType::class, ['required' => false,])
            ->add('fechaMin', DateType::class, ['required' => false, 'format' => 'dd MM y'])
            ->add('fechaMax', DateType::class, ['required' => false, 'format' => 'dd MM y'])
            ->add('horaMin', TimeType::class, ['required' => false,])
            ->add('horaMax', TimeType::class, ['required' => false,])

//            ->add('pistasIdaMin', IntegerType::class, ['required' => false,])
//            ->add('pistasIdaMax', IntegerType::class, ['required' => false,])
//            ->add('pistasRegresoMin', IntegerType::class, ['required' => false,])
//            ->add('pistasRegresoMax', IntegerType::class, ['required' => false,])

//            ->add('latitudMin', TextType::class, ['required' => false,])
//            ->add('latitudMax', TextType::class, ['required' => false,])
//            ->add('longitudMin', TextType::class, ['required' => false,])
//            ->add('longitudMax', TextType::class, ['required' => false,])


// Institucional
            ->add('unidad', EntityType::class, [
                'label' => 'inspeccion.accidente.unidad',
                'required' => false,
                'multiple' => true,
                'class' => Unidad::class,
            ])

            ->add('funcionario', EntityType::class, [
                'label' => 'inspeccion.accidente.funcionario',
                'required' => false,
                'multiple' => true,
                'class' => Funcionario::class,
            ])

            ->add('tribunal', EntityType::class, [
                'label' => 'inspeccion.accidente.tribunal',
                'required' => false,
                'multiple' => true,
                'class' => Tribunal::class,
            ])

            ->add('numeroParte', null, [
                'label' => 'inspeccion.accidente.numeroParte',
                'required' => false,
            ])

            ->add('numeroFormulario', TextType::class, [
                'label' => 'inspeccion.accidente.numeroFormulario',
                'required' => false,
            ])

            ->add('esMensaje', CheckboxType::class, [
                'label' => 'inspeccion.accidente.esMensaje',
                'required' => false,
            ])

            ->add('concurreSiat', CheckboxType::class, [
                'label' => 'inspeccion.accidente.concurreSiat',
                'required' => false,
            ])

// Espacial
            ->add('region', EntityType::class, [
                'label' => 'inspeccion.accidente.region',
                'required' => false,
                'multiple' => true,
                'class' => Region::class,
            ])

            ->add('provincia', EntityType::class, [
                'label' => 'inspeccion.accidente.provincia',
                'required' => false,
                'multiple' => true,
                'class' => Provincia::class,
            ])

            ->add('comuna', EntityType::class, [
                'label' => 'inspeccion.accidente.comuna',
                'required' => false,
                'multiple' => true,
                'class' => Comuna::class,
            ])

            ->add('cuadrante', EntityType::class, [
                'label' => 'inspeccion.accidente.cuadrante',
                'required' => false,
                'multiple' => true,
                'class' => Cuadrante::class,
            ])

            ->add('tipoDireccion', EntityType::class, [
                'label' => 'inspeccion.accidente.tipoDireccion',
                'required' => false,
                'multiple' => true,
                'class' => TipoDireccion::class,
            ])

            ->add('tipoUbicacionRelativaAccidente', EntityType::class, [
                'label' => 'inspeccion.accidente.tipoUbicacionRelativaAccidente',
                'required' => false,
                'multiple' => true,
                'class' => TipoUbicacionRelativaAccidente::class,
            ])

            ->add('tipoZonaAccidente', EntityType::class, [
                'label' => 'inspeccion.accidente.tipoZonaAccidente',
                'required' => false,
                'multiple' => true,
                'class' => TipoZonaAccidente::class,
            ])

// Cualidades de accidente
            ->add('estadoAccidente', EntityType::class, [
                'label' => 'inspeccion.accidente.estadoAccidente',
                'required' => false,
                'multiple' => true,
                'class' => EstadoAccidente::class,
            ])

            ->add('claseAccidente', EntityType::class, [
                'label' => 'inspeccion.accidente.claseAccidente',
                'required' => false,
                'multiple' => true,
                'class' => ClaseAccidente::class,
            ])

            ->add('tipoAccidente', EntityType::class, [
                'label' => 'inspeccion.accidente.tipoAccidente',
                'required' => false,
                'multiple' => true,
                'class' => TipoAccidente::class,
            ])

            ->add('tipoCausa', EntityType::class, [
                'label' => 'inspeccion.accidente.tipoCausa',
                'required' => false,
                'multiple' => true,
                'class' => TipoCausa::class,
            ])

            ->add('causaBasal', EntityType::class, [
                'label' => 'inspeccion.accidente.causaBasal',
                'required' => false,
                'multiple' => true,
                'class' => Causa::class,
            ])

            ->add('estadoAtmosferico', EntityType::class, [
                'label' => 'inspeccion.accidente.estadoAtmosferico',
                'required' => false,
                'multiple' => true,
                'class' => EstadoAtmosferico::class,
            ])

            ->add('tipoLuminosidad', EntityType::class, [
                'label' => 'inspeccion.accidente.tipoLuminosidad',
                'required' => false,
                'multiple' => true,
                'class' => TipoLuminosidad::class,
            ])

            ->add('estadoLuzArtificial', EntityType::class, [
                'label' => 'inspeccion.accidente.estadoLuzArtificial',
                'required' => false,
                'multiple' => true,
                'class' => EstadoLuzArtificial::class,
            ])

            ->add('tipoPavimentoCalzada', EntityType::class, [
                'label' => 'inspeccion.accidente.tipoPavimentoCalzada',
                'required' => false,
                'multiple' => true,
                'class' => TipoPavimentoCalzada::class,
            ])

            ->add('condicionPavimentoCalzada', EntityType::class, [
                'label' => 'inspeccion.accidente.condicionPavimentoCalzada',
                'required' => false,
                'multiple' => true,
                'class' => CondicionPavimentoCalzada::class,
            ])

            ->add('estadoPavimentoCalzada', EntityType::class, [
                'label' => 'inspeccion.accidente.estadoPavimentoCalzada',
                'required' => false,
                'multiple' => true,
                'class' => EstadoPavimentoCalzada::class,
            ])

            ->add('tipoCalzada', EntityType::class, [
                'label' => 'inspeccion.accidente.tipoCalzada',
                'required' => false,
                'multiple' => true,
                'class' => TipoCalzada::class,
            ])

            ->add('demarcacionLineaCalzada', EntityType::class, [
                'label' => 'inspeccion.accidente.demarcacionLineaCalzada',
                'required' => false,
                'multiple' => true,
                'class' => DemarcacionLineaCalzada::class,
            ])

            ->add('demarcacionPrioridadCalzada', EntityType::class, [
                'label' => 'inspeccion.accidente.demarcacionPrioridadCalzada',
                'required' => false,
                'multiple' => true,
                'class' => DemarcacionPrioridadCalzada::class,
            ])

            ->add('elementoCalzada', EntityType::class, [
                'label' => 'inspeccion.accidente.elementoCalzada',
                'required' => false,
                'multiple' => true,
                'class' => DemarcacionPrioridadCalzada::class,
            ])

// Vehicular
            ->add('tipoVehiculo', EntityType::class, [
                'label' => 'inspeccion.vehiculo.tipoVehiculo',
                'required' => false,
                'multiple' => true,
                'class' => TipoVehiculo::class,
            ])

            ->add('servicioVehiculo', EntityType::class, [
                'label' => 'inspeccion.vehiculo.servicioVehiculo',
                'required' => false,
                'multiple' => true,
                'class' => ServicioVehiculo::class,
            ])

            ->add('maniobraVehiculo', EntityType::class, [
                'label' => 'inspeccion.vehiculo.maniobraVehiculo',
                'required' => false,
                'multiple' => true,
                'class' => ManiobraVehiculo::class,
            ])

            ->add('direccionVehiculo', EntityType::class, [
                'label' => 'inspeccion.vehiculo.direccionVehiculo',
                'required' => false,
                'multiple' => true,
                'class' => DireccionVehiculo::class,
            ])

            ->add('consecuenciaVehiculo', EntityType::class, [
                'label' => 'inspeccion.vehiculo.consecuenciaVehiculo',
                'required' => false,
                'multiple' => true,
                'class' => ConsecuenciaVehiculo::class,
            ])

// Personales

            ->add('personaEsCausanteProbable', CheckboxType::class, [
                'label' => 'inspeccion.persona.personaEsCausanteProbable',
                'required' => false,
            ])

            ->add('personaSeFuga', CheckboxType::class, [
                'label' => 'inspeccion.persona.personaSeFuga',
                'required' => false,
            ])

            ->add('personaEsConductor', CheckboxType::class, [
                'label' => 'inspeccion.persona.personaEsConductor',
                'required' => false,
            ])

            ->add('claseLicencia', EntityType::class, [
                'label' => 'inspeccion.persona.claseLicencia',
                'required' => false,
                'multiple' => true,
                'class' => ClaseLicencia::class,
            ])

            ->add('comunaLicencia', EntityType::class, [
                'label' => 'inspeccion.persona.comunaLicencia',
                'required' => false,
                'multiple' => true,
                'class' => Comuna::class,
            ])

            ->add('condicionFisica', EntityType::class, [
                'label' => 'inspeccion.persona.condicionFisica',
                'required' => false,
                'multiple' => true,
                'class' => CondicionFisica::class,
            ])

            ->add('consecuenciaPersona', EntityType::class, [
                'label' => 'inspeccion.persona.consecuenciaPersona',
                'required' => false,
                'multiple' => true,
                'class' => ConsecuenciaPersona::class,
            ])

            ->add('cualidadEspecial', EntityType::class, [
                'label' => 'inspeccion.persona.cualidadEspecial',
                'required' => false,
                'multiple' => true,
                'class' => CualidadEspecial::class,
            ])

            ->add('tipoTrayecto', EntityType::class, [
                'label' => 'inspeccion.persona.tipoTrayecto',
                'required' => false,
                'multiple' => true,
                'class' => TipoTrayecto::class,
            ])

            ->add('seguridad', EntityType::class, [
                'label' => 'inspeccion.persona.seguridad',
                'required' => false,
                'multiple' => true,
                'class' => SeguridadPersona::class,
            ])

// Final

            ->add('submit', SubmitType::class, [
                'label' => 'Buscar'
            ])
        ;
    }

    public function getBlockPrefix()
    {
        return 'inspeccion';
    }

}
