<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class InspeccionAccidenteExportarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id', CheckboxType::class, ['label' => 'accidente.id', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('fecha', CheckboxType::class, ['label' => 'accidente.fecha', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('hora', CheckboxType::class, ['label' => 'accidente.hora', 'required' => false, 'attr' => ['checked' => 'checked']])

            ->add('cuadrante', CheckboxType::class, ['label' => 'accidente.cuadrante', 'required' => false])
            ->add('comuna', CheckboxType::class, ['label' => 'accidente.comuna', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('provincia', CheckboxType::class, ['label' => 'accidente.provincia', 'required' => false])
            ->add('region', CheckboxType::class, ['label' => 'accidente.region', 'required' => false])

            ->add('unidad', CheckboxType::class, ['label' => 'accidente.unidad', 'required' => false])
            ->add('funcionario', CheckboxType::class, ['label' => 'accidente.funcionario', 'required' => false])
            ->add('tribunal', CheckboxType::class, ['label' => 'accidente.tribunal', 'required' => false])
            ->add('numeroParte', CheckboxType::class, ['label' => 'accidente.numeroParte', 'required' => false])
            ->add('numeroFormulario', CheckboxType::class, ['label' => 'accidente.numeroFormulario', 'required' => false])
            ->add('concurreSiat', CheckboxType::class, ['label' => 'accidente.concurreSiat', 'required' => false])
            ->add('esMensaje', CheckboxType::class, ['label' => 'accidente.esMensaje', 'required' => false])

            ->add('cantidadPistasIda', CheckboxType::class, ['label' => 'accidente.cantidad.cantidadPistasIda', 'required' => false])
            ->add('cantidadPistasRegreso', CheckboxType::class, ['label' => 'accidente.cantidad.cantidadPistasRegreso', 'required' => false])
            ->add('vehiculosAccidente', CheckboxType::class, ['label' => 'accidente.cantidad.vehiculosAccidente', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('pasajerosAccidente', CheckboxType::class, ['label' => 'accidente.cantidad.pasajerosAccidente', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('peatonesAccidente', CheckboxType::class, ['label' => 'accidente.cantidad.peatonesAccidente', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('personasAccidente', CheckboxType::class, ['label' => 'accidente.cantidad.personasAccidente', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('fallecidosAccidente', CheckboxType::class, ['label' => 'accidente.cantidad.fallecidosAccidente', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('gravesAccidente', CheckboxType::class, ['label' => 'accidente.cantidad.gravesAccidente', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('menosGravesAccidente', CheckboxType::class, ['label' => 'accidente.cantidad.menosGravesAccidente', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('levesAccidente', CheckboxType::class, ['label' => 'accidente.cantidad.levesAccidente', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('ilesosAccidente', CheckboxType::class, ['label' => 'accidente.cantidad.ilesosAccidente', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('seIgnoraAccidente', CheckboxType::class, ['label' => 'accidente.cantidad.seIgnoraAccidente', 'required' => false, 'attr' => ['checked' => 'checked']])

            ->add('glosa', CheckboxType::class, ['label' => 'accidente.glosa', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('calle', CheckboxType::class, ['label' => 'accidente.calle', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('numero', CheckboxType::class, ['label' => 'accidente.numero', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('direccion', CheckboxType::class, ['label' => 'accidente.direccion', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('latitud', CheckboxType::class, ['label' => 'accidente.latitud', 'required' => false])
            ->add('longitud', CheckboxType::class, ['label' => 'accidente.longitud', 'required' => false])

            ->add('tipoDireccion', CheckboxType::class, ['label' => 'accidente.tipoDireccion', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('tipoUbicacionRelativaAccidente', CheckboxType::class, ['label' => 'accidente.tipoUbicacionRelativaAccidente', 'required' => false])
            ->add('tipoZonaAccidente', CheckboxType::class, ['label' => 'accidente.tipoZonaAccidente', 'required' => false])

            ->add('claseAccidente', CheckboxType::class, ['label' => 'accidente.claseAccidente', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('tipoAccidente', CheckboxType::class, ['label' => 'accidente.tipoAccidente', 'required' => false])
            ->add('causaBasal', CheckboxType::class, ['label' => 'accidente.causaBasal', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('tipoCausa', CheckboxType::class, ['label' => 'accidente.tipoCausa', 'required' => false])

            ->add('estadoAccidente', CheckboxType::class, ['label' => 'accidente.estadoAccidente', 'required' => false])
            ->add('registroEtapas', CheckboxType::class, ['label' => 'accidente.registroEtapas', 'required' => false])
            ->add('incoherencias', CheckboxType::class, ['label' => 'accidente.incoherencias', 'required' => false])

            ->add('estadoAtmosferico', CheckboxType::class, ['label' => 'accidente.estadoAtmosferico', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('tipoLuminosidad', CheckboxType::class, ['label' => 'accidente.tipoLuminosidad', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('estadoLuzArtificial', CheckboxType::class, ['label' => 'accidente.estadoLuzArtificial', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('tipoPavimentoCalzada', CheckboxType::class, ['label' => 'accidente.tipoPavimentoCalzada', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('condicionPavimentoCalzada', CheckboxType::class, ['label' => 'accidente.condicionPavimentoCalzada', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('estadoPavimentoCalzada', CheckboxType::class, ['label' => 'accidente.estadoPavimentoCalzada', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('tipoCalzada', CheckboxType::class, ['label' => 'accidente.tipoCalzada', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('demarcacionLineaCalzada', CheckboxType::class, ['label' => 'accidente.demarcacionLineaCalzada', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('demarcacionPrioridadCalzada', CheckboxType::class, ['label' => 'accidente.demarcacionPrioridadCalzada', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('elementosCalzada', CheckboxType::class, ['label' => 'accidente.elementosCalzada', 'required' => false, 'attr' => ['checked' => 'checked']])

            ->add('submit', SubmitType::class, ['label' => 'exportacion.accidente.submit', 'attr' => ['class' => 'btn btn-primary btn-lg btn-block']])
        ;
    }

    public function getBlockPrefix()
    {
        return 'exportar';
    }

}
