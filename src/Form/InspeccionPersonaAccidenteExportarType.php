<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class InspeccionPersonaAccidenteExportarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('run', CheckboxType::class, ['label' => 'persona.run', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('nombres', CheckboxType::class, ['label' => 'persona.nombres', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('apellidoPaterno', CheckboxType::class, ['label' => 'persona.apellidoPaterno', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('apellidoMaterno', CheckboxType::class, ['label' => 'persona.apellidoMaterno', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('ocupacion', CheckboxType::class, ['label' => 'persona.ocupacion', 'required' => false])
            ->add('genero', CheckboxType::class, ['label' => 'persona.genero', 'required' => false])
            ->add('estadoCivil', CheckboxType::class, ['label' => 'persona.estadoCivil', 'required' => false])
            ->add('nacionalidad', CheckboxType::class, ['label' => 'persona.nacionalidad', 'required' => false])
            ->add('lugarNacimiento', CheckboxType::class, ['label' => 'persona.lugarNacimiento', 'required' => false])
            ->add('fechaNacimiento', CheckboxType::class, ['label' => 'persona.fechaNacimiento', 'required' => false])

            ->add('edad', CheckboxType::class, ['label' => 'persona.edad', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('calidadPersona', CheckboxType::class, ['label' => 'persona.calidadPersona', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('claseLicencia', CheckboxType::class, ['label' => 'persona.claseLicencia', 'required' => false])
            ->add('comunaLicencia', CheckboxType::class, ['label' => 'persona.comunaLicencia', 'required' => false])
            ->add('condicionFisica', CheckboxType::class, ['label' => 'persona.condicionFisica', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('consecuenciaPersona', CheckboxType::class, ['label' => 'persona.consecuenciaPersona', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('cualidadEspecial', CheckboxType::class, ['label' => 'persona.cualidadEspecial', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('tipoTrayecto', CheckboxType::class, ['label' => 'persona.tipoTrayecto', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('seguridad', CheckboxType::class, ['label' => 'persona.seguridad', 'required' => false])
            ->add('personaEsCausanteProbable', CheckboxType::class, ['label' => 'persona.personaEsCausanteProbable', 'required' => false])
            ->add('personaSeFuga', CheckboxType::class, ['label' => 'persona.personaSeFuga', 'required' => false])

            ->add('placaPatenteUnica', CheckboxType::class, ['label' => 'vehiculo.placaPatenteUnica', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('marcaVehiculo', CheckboxType::class, ['label' => 'vehiculo.marcaVehiculo', 'required' => false])
            ->add('modeloVehiculo', CheckboxType::class, ['label' => 'vehiculo.modeloVehiculo', 'required' => false])
            ->add('ano', CheckboxType::class, ['label' => 'vehiculo.ano', 'required' => false])
            ->add('color', CheckboxType::class, ['label' => 'vehiculo.color', 'required' => false])
            ->add('tipoVehiculo', CheckboxType::class, ['label' => 'vehiculo.tipoVehiculo', 'required' => false, 'attr' => ['checked' => 'checked']])

            ->add('direccionVehiculo', CheckboxType::class, ['label' => 'vehiculo.direccionVehiculo', 'required' => false])
            ->add('servicioVehiculo', CheckboxType::class, ['label' => 'vehiculo.servicioVehiculo', 'required' => false])
            ->add('maniobraVehiculo', CheckboxType::class, ['label' => 'vehiculo.maniobraVehiculo', 'required' => false])
            ->add('consecuenciaVehiculo', CheckboxType::class, ['label' => 'vehiculo.consecuenciaVehiculo', 'required' => false])
            ->add('vehiculoEsCausanteProbable', CheckboxType::class, ['label' => 'vehiculo.vehiculoEsCausanteProbable', 'required' => false])
            ->add('vehiculoSeFuga', CheckboxType::class, ['label' => 'vehiculo.vehiculoSeFuga', 'required' => false])

            ->add('id', CheckboxType::class, ['label' => 'accidente.id', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('fecha', CheckboxType::class, ['label' => 'accidente.fecha', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('hora', CheckboxType::class, ['label' => 'accidente.hora', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('creado', CheckboxType::class, ['label' => 'accidente.creado', 'required' => false])
            ->add('actualizado', CheckboxType::class, ['label' => 'accidente.actualizado', 'required' => false])

            ->add('region', CheckboxType::class, ['label' => 'accidente.region', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('provincia', CheckboxType::class, ['label' => 'accidente.provincia', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('comuna', CheckboxType::class, ['label' => 'accidente.comuna', 'required' => false, 'attr' => ['checked' => 'checked']])
//            ->add('cuadrante', CheckboxType::class, ['label' => 'accidente.cuadrante', 'required' => false])

//            ->add('glosa', CheckboxType::class, ['label' => 'accidente.glosa', 'required' => false, 'attr' => ['checked' => 'checked']])
//            ->add('calle', CheckboxType::class, ['label' => 'accidente.calle', 'required' => false, 'attr' => ['checked' => 'checked']])
//            ->add('numero', CheckboxType::class, ['label' => 'accidente.numero', 'required' => false, 'attr' => ['checked' => 'checked']])
//            ->add('direccion', CheckboxType::class, ['label' => 'accidente.direccion', 'required' => false, 'attr' => ['checked' => 'checked']])
//            ->add('latitud', CheckboxType::class, ['label' => 'accidente.latitud', 'required' => false, 'attr' => ['checked' => 'checked']])
//            ->add('longitud', CheckboxType::class, ['label' => 'accidente.longitud', 'required' => false, 'attr' => ['checked' => 'checked']])

//            ->add('maestroId', CheckboxType::class, ['label' => 'accidente.maestroId', 'required' => false])
//            ->add('tipoId', CheckboxType::class, ['label' => 'accidente.tipoId', 'required' => false])
//            ->add('tipo', CheckboxType::class, ['label' => 'accidente.tipo', 'required' => false])
//            ->add('pais', CheckboxType::class, ['label' => 'accidente.pais', 'required' => false])
//            ->add('comuna', CheckboxType::class, ['label' => 'accidente.comuna', 'required' => false, 'attr' => ['checked' => 'checked']])

//            ->add('unidad', CheckboxType::class, ['label' => 'accidente.unidad', 'required' => false])
//            ->add('funcionario', CheckboxType::class, ['label' => 'accidente.funcionario', 'required' => false])
//            ->add('funcionarioResponsable', CheckboxType::class, ['label' => 'accidente.funcionarioResponsable', 'required' => false])
//            ->add('tribunal', CheckboxType::class, ['label' => 'accidente.tribunal', 'required' => false])
//            ->add('numeroParte', CheckboxType::class, ['label' => 'accidente.numeroParte', 'required' => false])
//            ->add('numeroFormulario', CheckboxType::class, ['label' => 'accidente.numeroFormulario', 'required' => false])
//            ->add('concurreSiat', CheckboxType::class, ['label' => 'accidente.concurreSiat', 'required' => false])
//            ->add('esMensaje', CheckboxType::class, ['label' => 'accidente.esMensaje', 'required' => false])
//            ->add('aclaratoria', CheckboxType::class, ['label' => 'accidente.aclaratoria', 'required' => false])

//            ->add('cantidadPistasIda', CheckboxType::class, ['label' => 'accidente.cantidad.cantidadPistasIda', 'required' => false])
//            ->add('cantidadPistasRegreso', CheckboxType::class, ['label' => 'accidente.cantidad.cantidadPistasRegreso', 'required' => false])
//            ->add('vehiculosAccidente', CheckboxType::class, ['label' => 'accidente.cantidad.vehiculosAccidente', 'required' => false, 'attr' => ['checked' => 'checked']])
//            ->add('pasajerosAccidente', CheckboxType::class, ['label' => 'accidente.cantidad.pasajerosAccidente', 'required' => false, 'attr' => ['checked' => 'checked']])
//            ->add('peatonesAccidente', CheckboxType::class, ['label' => 'accidente.cantidad.peatonesAccidente', 'required' => false, 'attr' => ['checked' => 'checked']])
//            ->add('personasAccidente', CheckboxType::class, ['label' => 'accidente.cantidad.personasAccidente', 'required' => false, 'attr' => ['checked' => 'checked']])
//            ->add('fallecidosAccidente', CheckboxType::class, ['label' => 'accidente.cantidad.fallecidosAccidente', 'required' => false, 'attr' => ['checked' => 'checked']])
//            ->add('gravesAccidente', CheckboxType::class, ['label' => 'accidente.cantidad.gravesAccidente', 'required' => false, 'attr' => ['checked' => 'checked']])
//            ->add('menosGravesAccidente', CheckboxType::class, ['label' => 'accidente.cantidad.menosGravesAccidente', 'required' => false, 'attr' => ['checked' => 'checked']])
//            ->add('levesAccidente', CheckboxType::class, ['label' => 'accidente.cantidad.levesAccidente', 'required' => false, 'attr' => ['checked' => 'checked']])
//            ->add('ilesosAccidente', CheckboxType::class, ['label' => 'accidente.cantidad.ilesosAccidente', 'required' => false, 'attr' => ['checked' => 'checked']])
//            ->add('seIgnoraAccidente', CheckboxType::class, ['label' => 'accidente.cantidad.seIgnoraAccidente', 'required' => false, 'attr' => ['checked' => 'checked']])

//            ->add('estadoAtmosferico', CheckboxType::class, ['label' => 'accidente.estadoAtmosferico', 'required' => false])
//            ->add('tipoLuminosidad', CheckboxType::class, ['label' => 'accidente.tipoLuminosidad', 'required' => false])
//            ->add('estadoLuzArtificial', CheckboxType::class, ['label' => 'accidente.estadoLuzArtificial', 'required' => false])
//            ->add('tipoPavimentoCalzada', CheckboxType::class, ['label' => 'accidente.tipoPavimentoCalzada', 'required' => false])
//            ->add('condicionPavimentoCalzada', CheckboxType::class, ['label' => 'accidente.condicionPavimentoCalzada', 'required' => false])
//            ->add('estadoPavimentoCalzada', CheckboxType::class, ['label' => 'accidente.estadoPavimentoCalzada', 'required' => false])
//            ->add('demarcacionPrioridadCalzada', CheckboxType::class, ['label' => 'accidente.demarcacionPrioridadCalzada', 'required' => false])
//            ->add('demarcacionLineaCalzada', CheckboxType::class, ['label' => 'accidente.demarcacionLineaCalzada', 'required' => false])
//            ->add('tipoCalzada', CheckboxType::class, ['label' => 'accidente.tipoCalzada', 'required' => false])

            ->add('claseAccidente', CheckboxType::class, ['label' => 'accidente.claseAccidente', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('tipoAccidente', CheckboxType::class, ['label' => 'accidente.tipoAccidente', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('causaBasal', CheckboxType::class, ['label' => 'accidente.causaBasal', 'required' => false, 'attr' => ['checked' => 'checked']])
//            ->add('tipoDireccion', CheckboxType::class, ['label' => 'accidente.tipoDireccion', 'required' => false, 'attr' => ['checked' => 'checked']])
//            ->add('tipoUbicacionRelativaAccidente', CheckboxType::class, ['label' => 'accidente.tipoUbicacionRelativaAccidente', 'required' => false, 'attr' => ['checked' => 'checked']])
//            ->add('tipoZonaAccidente', CheckboxType::class, ['label' => 'accidente.tipoZonaAccidente', 'required' => false, 'attr' => ['checked' => 'checked']])

            ->add('submit', SubmitType::class, ['label' => 'exportacion.persona.submit', 'attr' => ['class' => 'btn btn-primary btn-lg btn-block']])
        ;
    }

    public function getBlockPrefix()
    {
        return 'exportar';
    }

}
