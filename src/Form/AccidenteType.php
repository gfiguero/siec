<?php

namespace App\Form;

use App\Entity\Accidente;
use App\Entity\ClaseAccidente;
use App\Entity\TipoAccidente;

use App\Entity\Comuna;
use App\Entity\Cuadrante;
use App\Entity\Unidad;
use App\Entity\Funcionario;
use App\Entity\Tribunal;

use App\Entity\Causa;

use App\Entity\EstadoAtmosferico;
use App\Entity\TipoLuminosidad;
use App\Entity\TipoLuzArtificial;
use App\Entity\EstadoLuzArtificial;
use App\Entity\TipoPavimentoCalzada;
use App\Entity\CondicionPavimentoCalzada;
use App\Entity\EstadoPavimentoCalzada;
use App\Entity\DemarcacionLineaCalzada;
use App\Entity\DemarcacionPrioridadCalzada;
use App\Entity\ElementoCalzada;
use App\Entity\TipoCalzada;

use App\Entity\TipoZonaAccidente;
use App\Entity\TipoUbicacionRelativaAccidente;
use App\Entity\TipoDireccion;


use App\Repository\CausaRepository;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class AccidenteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('claseAccidente', EntityType::class, [
            'class' => ClaseAccidente::class,
            'label' => 'accidente.claseAccidente',
            'placeholder' => 'Seleccione',
            'required' => true,
        ]);

        $tipoAccidenteModifier = function (FormInterface $form, ClaseAccidente $claseAccidente = null) {
            $tiposAccidente = null === $claseAccidente ? [] : $claseAccidente->getTiposAccidente();
            $form->add('tipoAccidente', EntityType::class, [
                'class' => TipoAccidente::class,
                'label' => 'accidente.tipoAccidente',
                'placeholder' => 'Seleccione',
                'required' => true,
                'choices' => $tiposAccidente,
            ]);

            $tipoUbicacionRelativaAccidente = null === $claseAccidente ? [] : $claseAccidente->getTiposUbicacionRelativaAccidente();
            $form->add('tipoUbicacionRelativaAccidente', EntityType::class, [
                'class' => TipoUbicacionRelativaAccidente::class,
                'label' => 'accidente.tipoUbicacionRelativaAccidente',
                'placeholder' => 'Seleccione',
                'required' => true,
                'choices' => $tipoUbicacionRelativaAccidente,
            ]);
        };

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($tipoAccidenteModifier) {
                $data = $event->getData();
                $tipoAccidenteModifier($event->getForm(), $data->getClaseAccidente());
            }
        );

        $builder->get('claseAccidente')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($tipoAccidenteModifier) {
                $claseAccidente = $event->getForm()->getData();
                $tipoAccidenteModifier($event->getForm()->getParent(), $claseAccidente);
            }
        );

        $builder->add('fecha', DateType::class, [
            'label' => 'accidente.fecha',
            'required' => true,
        ]);

        $builder->add('hora', TimeType::class, [
            'label' => 'accidente.hora',
            'required' => true,
        ]);

        $builder->add('aclaratoria', TextareaType::class, [
            'label' => 'accidente.aclaratoria',
            'required' => false,
            'attr' => ['maxlength' => '300'],
        ]);

        $builder->add('numeroParte', TextType::class, [
            'label' => 'accidente.numeroParte',
            'required' => true,
            'attr' => ['maxlength' => '15','pattern' => '(\d*)'],
        ]);

        $builder->add('numeroFormulario', IntegerType::class, [
            'label' => 'accidente.numeroFormulario',
            'required' => true,
        ]);

        $builder->add('concurreSiat', CheckboxType::class, [
            'label' => 'accidente.concurreSiat',
            'required' => false,
        ]);

        $builder->add('unidad', EntityType::class, [
            'class' => Unidad::class,
            'label' => 'accidente.unidad',
            'placeholder' => 'Seleccione',
            'required' => true,
        ]);

        $funcionarioModifier = function (FormInterface $form, Unidad $unidad = null) {
            $funcionarios = null === $unidad ? [] : $unidad->getFuncionarios();
            $form->add('funcionario', EntityType::class, [
                'class' => Funcionario::class,
                'label' => 'accidente.funcionario',
                'placeholder' => 'Seleccione',
                'required' => true,
                'choices' => $funcionarios,
            ]);
            $form->add('funcionarioResponsable', EntityType::class, [
                'class' => Funcionario::class,
                'label' => 'accidente.funcionarioResponsable',
                'placeholder' => 'Seleccione',
                'required' => true,
                'choices' => $funcionarios,
            ]);
        };

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($funcionarioModifier) {
                $data = $event->getData();
                $funcionarioModifier($event->getForm(), $data->getUnidad());
            }
        );

        $builder->get('unidad')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($funcionarioModifier) {
                $unidad = $event->getForm()->getData();
                $funcionarioModifier($event->getForm()->getParent(), $unidad);
            }
        );

        $builder->add('tribunal', EntityType::class, [
            'class' => Tribunal::class,
            'label' => 'accidente.tribunal',
            'placeholder' => 'Seleccione',
            'required' => true,
        ]);

        $builder->add('causaBasal', EntityType::class, [
            'class' => Causa::class,
            'label' => 'accidente.causaBasal',
            'placeholder' => 'Seleccione',
            'required' => true,
        ]);

        $causasModifier = function (FormInterface $form, Causa $causaBasal = null) {
            $form->add('causas', EntityType::class, [
                'class' => Causa::class,
                'label' => 'accidente.causas',
                'placeholder' => 'Seleccione',
                'required' => false,
                'multiple' => true,
                'query_builder' => function (CausaRepository $repository) use ($causaBasal) {
                    return $repository->causasConcurrentes($causaBasal);
                },
            ]);
        };

        $builder->get('causaBasal')->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($causasModifier) {
                $causaBasal = $event->getData();
                $causasModifier($event->getForm()->getParent(), $causaBasal);
            }
        );

        $builder->get('causaBasal')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($causasModifier) {
                $causaBasal = $event->getForm()->getData();
                $causasModifier($event->getForm()->getParent(), $causaBasal);
            }
        );

        $builder->add('estadoAtmosferico', EntityType::class, [
            'class' => EstadoAtmosferico::class,
            'label' => 'accidente.estadoAtmosferico',
            'placeholder' => 'Seleccione',
            'required' => true,
        ]);

        $builder->add('tipoLuminosidad', EntityType::class, [
            'class' => TipoLuminosidad::class,
            'label' => 'accidente.tipoLuminosidad',
            'placeholder' => 'Seleccione',
            'required' => true,
        ]);

        $builder->add('estadoLuzArtificial', EntityType::class, [
            'class' => EstadoLuzArtificial::class,
            'label' => 'accidente.estadoLuzArtificial',
            'placeholder' => 'Seleccione',
            'required' => true,
        ]);

        $builder->add('tipoPavimentoCalzada', EntityType::class, [
            'class' => TipoPavimentoCalzada::class,
            'label' => 'accidente.tipoPavimentoCalzada',
            'placeholder' => 'Seleccione',
            'required' => true,
        ]);

        $builder->add('condicionPavimentoCalzada', EntityType::class, [
            'class' => CondicionPavimentoCalzada::class,
            'label' => 'accidente.condicionPavimentoCalzada',
            'placeholder' => 'Seleccione',
            'required' => true,
        ]);

        $builder->add('estadoPavimentoCalzada', EntityType::class, [
            'class' => EstadoPavimentoCalzada::class,
            'label' => 'accidente.estadoPavimentoCalzada',
            'placeholder' => 'Seleccione',
            'required' => true,
        ]);

        $builder->add('demarcacionPrioridadCalzada', EntityType::class, [
            'class'    => DemarcacionPrioridadCalzada::class,
            'label' => 'accidente.demarcacionPrioridadCalzada',
            'placeholder' => 'Seleccione',
            'required' => true,
        ]);

        $builder->add('demarcacionLineaCalzada', EntityType::class, [
            'class' => DemarcacionLineaCalzada::class,
            'label' => 'accidente.demarcacionLineaCalzada',
            'placeholder' => 'Seleccione',
            'required' => true,
        ]);

        $builder->add('elementosCalzada', EntityType::class, [
            'class' => ElementoCalzada::class,
            'label' => 'accidente.elementosCalzada',
            'placeholder' => 'Seleccione',
            'required' => true,
            'multiple' => true,
            'expanded' => true,
        ]);

        $builder->add('tipoCalzada', EntityType::class, [
            'class' => TipoCalzada::class,
            'label' => 'accidente.tipoCalzada',
            'placeholder' => 'Seleccione',
        ]);

        $builder->add('cantidadPistasIda', ChoiceType::class, [
            'label' => 'accidente.cantidadPistasIda',
            'placeholder' => 'Seleccione',
            'required' => true,
            'choices'  => [
                '1 Pista'  => '1',
                '2 Pistas' => '2',
                '3 Pistas' => '3',
                '4 Pistas' => '4',
                '5 Pistas' => '5',
                '6 Pistas' => '6',
                '7 Pistas' => '7',
                '8 Pistas' => '8',
                '9 Pistas' => '9',
            ],
        ]);

        $builder->add('cantidadPistasRegreso', ChoiceType::class, [
            'label' => 'accidente.cantidadPistasRegreso',
            'placeholder' => 'Seleccione',
            'required' => true,
            'choices'  => [
                'Sin pista de regreso' => '0',
                '1 Pista'  => '1',
                '2 Pistas' => '2',
                '3 Pistas' => '3',
                '4 Pistas' => '4',
                '5 Pistas' => '5',
                '6 Pistas' => '6',
                '7 Pistas' => '7',
                '8 Pistas' => '8',
                '9 Pistas' => '9',
            ],
        ]);

        $builder->add('comuna', EntityType::class, [
            'class' => Comuna::class,
            'label' => 'accidente.comuna',
            'placeholder' => 'Seleccione',
            'required' => true,
        ]);

        $cuadranteModifier = function (FormInterface $form, Comuna $comuna = null) {
            $cuadrantes = null === $comuna ? [] : $comuna->getCuadrantes();
            $form->add('cuadrante', EntityType::class, [
                'class' => Cuadrante::class,
                'label' => 'accidente.cuadrante',
                'placeholder' => 'Desconocido',
                'required' => false,
                'choices' => $cuadrantes,
            ]);
        };

        $builder->get('comuna')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($cuadranteModifier) {
                $comuna = $event->getForm()->getData();
                $cuadranteModifier($event->getForm()->getParent(), $comuna);
            }
        );

        $builder->get('comuna')->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($cuadranteModifier) {
                $comuna = $event->getData();
                $cuadranteModifier($event->getForm()->getParent(), $comuna);
            }
        );


        $builder->add('tipoZonaAccidente', EntityType::class, [
            'class' => TipoZonaAccidente::class,
            'label' => 'accidente.tipoZonaAccidente',
            'placeholder' => 'Seleccione',
            'required' => true,
        ]);

        $builder->add('tipoDireccion', EntityType::class, [
            'class' => TipoDireccion::class,
            'label' => 'accidente.tipoDireccion',
            'placeholder' => 'Seleccione',
            'required' => true,
        ]);

        $builder->add('ubicacion', UbicacionAccidenteType::class);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Accidente::class,
        ]);
    }
}
