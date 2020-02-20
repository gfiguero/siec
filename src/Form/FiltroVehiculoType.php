<?php

namespace App\Form;

use App\Entity\Comuna;
use App\Entity\Provincia;
use App\Entity\Region;
use App\Entity\Funcionario;
use App\Entity\Tribunal;
use App\Entity\Unidad;
use App\Entity\TipoCausa;
use App\Entity\TipoUbicacionRelativaAccidente;
use App\Entity\TipoUnidad;
use App\Entity\TipoCalzada;
use App\Entity\DemarcacionLineaCalzada;
use App\Entity\DemarcacionPrioridadCalzada;
use App\Entity\ElementoCalzada;
use App\Entity\EstadoAtmosferico;
use App\Entity\EstadoPavimentoCalzada;
use App\Entity\TipoDireccion;
use App\Entity\TipoPavimentoCalzada;
use App\Entity\TipoZonaAccidente;
use App\Entity\Causa;
use App\Entity\ClaseAccidente;
use App\Entity\CondicionPavimentoCalzada;
use App\Entity\EstadoLuzArtificial;
use App\Entity\TipoAccidente;
use App\Entity\TipoLuminosidad;
use App\Entity\EstadoAccidente;

use App\Entity\TipoVehiculo;
use App\Entity\ServicioVehiculo;
use App\Entity\ManiobraVehiculo;
use App\Entity\DireccionVehiculo;
use App\Entity\ConsecuenciaVehiculo;

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

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class FiltroVehiculoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

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

            ->add('numeroFormulario', TextType::class, [
                'label' => 'inspeccion.numeroFormulario',
                'required' => false,
            ])

            ->add('numeroParte', null, [
                'label' => 'inspeccion.numeroParte',
                'required' => false,
            ])

            ->add('esMensaje', CheckboxType::class, [
                'label' => 'inspeccion.esMensaje',
                'required' => false,
            ])

            ->add('concurreSiat', CheckboxType::class, [
                'label' => 'inspeccion.concurreSiat',
                'required' => false,
            ])

            ->add('comuna', EntityType::class, [
                'label' => 'inspeccion.comuna',
                'required' => false,
                'multiple' => true,
                'class' => Comuna::class,
            ])

            ->add('provincia', EntityType::class, [
                'label' => 'inspeccion.provincia',
                'required' => false,
                'multiple' => true,
                'class' => Provincia::class,
            ])

            ->add('region', EntityType::class, [
                'label' => 'inspeccion.region',
                'required' => false,
                'multiple' => true,
                'class' => Region::class,
            ])

            ->add('funcionario', EntityType::class, [
                'label' => 'inspeccion.funcionario',
                'required' => false,
                'multiple' => true,
                'class' => Funcionario::class,
            ])

            ->add('tribunal', EntityType::class, [
                'label' => 'inspeccion.tribunal',
                'required' => false,
                'multiple' => true,
                'class' => Tribunal::class,
            ])

            ->add('unidad', EntityType::class, [
                'label' => 'inspeccion.unidad',
                'required' => false,
                'multiple' => true,
                'class' => Unidad::class,
            ])

            ->add('tipoCausa', EntityType::class, [
                'label' => 'inspeccion.tipoCausa',
                'required' => false,
                'multiple' => true,
                'class' => TipoCausa::class,
            ])

            ->add('tipoUbicacionRelativaAccidente', EntityType::class, [
                'label' => 'inspeccion.tipoUbicacionRelativaAccidente',
                'required' => false,
                'multiple' => true,
                'class' => TipoUbicacionRelativaAccidente::class,
            ])

            ->add('tipoCalzada', EntityType::class, [
                'label' => 'inspeccion.tipoCalzada',
                'required' => false,
                'multiple' => true,
                'class' => TipoCalzada::class,
            ])

            ->add('demarcacionLineaCalzada', EntityType::class, [
                'label' => 'inspeccion.demarcacionLineaCalzada',
                'required' => false,
                'multiple' => true,
                'class' => DemarcacionLineaCalzada::class,
            ])

            ->add('demarcacionPrioridadCalzada', EntityType::class, [
                'label' => 'inspeccion.demarcacionPrioridadCalzada',
                'required' => false,
                'multiple' => true,
                'class' => DemarcacionPrioridadCalzada::class,
            ])

            ->add('estadoAtmosferico', EntityType::class, [
                'label' => 'inspeccion.estadoAtmosferico',
                'required' => false,
                'multiple' => true,
                'class' => EstadoAtmosferico::class,
            ])

            ->add('estadoPavimentoCalzada', EntityType::class, [
                'label' => 'inspeccion.estadoPavimentoCalzada',
                'required' => false,
                'multiple' => true,
                'class' => EstadoPavimentoCalzada::class,
            ])

            ->add('tipoDireccion', EntityType::class, [
                'label' => 'inspeccion.tipoDireccion',
                'required' => false,
                'multiple' => true,
                'class' => TipoDireccion::class,
            ])

            ->add('tipoPavimentoCalzada', EntityType::class, [
                'label' => 'inspeccion.tipoPavimentoCalzada',
                'required' => false,
                'multiple' => true,
                'class' => TipoPavimentoCalzada::class,
            ])

            ->add('tipoZonaAccidente', EntityType::class, [
                'label' => 'inspeccion.tipoZonaAccidente',
                'required' => false,
                'multiple' => true,
                'class' => TipoZonaAccidente::class,
            ])

            ->add('causaBasal', EntityType::class, [
                'label' => 'inspeccion.causaBasal',
                'required' => false,
                'multiple' => true,
                'class' => Causa::class,
            ])

            ->add('claseAccidente', EntityType::class, [
                'label' => 'inspeccion.claseAccidente',
                'required' => false,
                'multiple' => true,
                'class' => ClaseAccidente::class,
            ])

            ->add('condicionPavimentoCalzada', EntityType::class, [
                'label' => 'inspeccion.condicionPavimentoCalzada',
                'required' => false,
                'multiple' => true,
                'class' => CondicionPavimentoCalzada::class,
            ])

            ->add('estadoLuzArtificial', EntityType::class, [
                'label' => 'inspeccion.estadoLuzArtificial',
                'required' => false,
                'multiple' => true,
                'class' => EstadoLuzArtificial::class,
            ])

            ->add('tipoAccidente', EntityType::class, [
                'label' => 'inspeccion.tipoAccidente',
                'required' => false,
                'multiple' => true,
                'class' => TipoAccidente::class,
            ])

            ->add('tipoLuminosidad', EntityType::class, [
                'label' => 'inspeccion.tipoLuminosidad',
                'required' => false,
                'multiple' => true,
                'class' => TipoLuminosidad::class,
            ])

            ->add('estadoAccidente', EntityType::class, [
                'label' => 'inspeccion.estadoAccidente',
                'required' => false,
                'multiple' => true,
                'class' => EstadoAccidente::class,
            ])

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
