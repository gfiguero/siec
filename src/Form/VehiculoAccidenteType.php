<?php

namespace App\Form;

use App\Entity\VehiculoAccidente;
use App\Entity\ConsecuenciaVehiculo;
use App\Entity\DireccionVehiculo;
use App\Entity\ManiobraVehiculo;
use App\Entity\ServicioVehiculo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Form\VehiculoType;
use App\Form\PersonaType;

class VehiculoAccidenteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('vehiculo', VehiculoType::class, [
            'label' => null,
            'required' => true,
        ]);

        $builder->add('conductorAccidente', CollectionType::class, [
            'entry_type' => ConductorAccidenteType::class,
            'by_reference' => false,
            'label' => null,
            'allow_add' => true,
            'allow_delete' => false,
            'required' => true,
            'prototype' => true,
            'prototype_name' => '__children_name__',
            'attr' => ['class' => "conductor-vehiculo-collection"],
        ]);

        $builder->add('pasajerosAccidente', CollectionType::class, [
            'entry_type' => PasajeroAccidenteType::class,
            'by_reference' => false,
            'label' => null,
            'allow_add' => true,
            'allow_delete' => true,
            'required' => true,
            'prototype' => true,
            'prototype_name' => '__children_name__',
            'attr' => ['class' => "pasajero-vehiculo-collection"],
        ]);

        $builder->add('consecuenciaVehiculo', EntityType::class, [
            'class' => ConsecuenciaVehiculo::class,
            'label' => 'accidente.consecuenciaVehiculo',
            'placeholder' => 'Seleccione',
            'required' => true,
            'attr' => ['class' => 'simple-select'],
        ]);

        $builder->add('direccionVehiculo', EntityType::class, [
            'class' => DireccionVehiculo::class,
            'label' => 'accidente.direccionVehiculo',
            'placeholder' => 'Seleccione',
            'required' => true,
            'attr' => ['class' => 'simple-select'],
        ]);

        $builder->add('maniobraVehiculo', EntityType::class, [
            'class' => ManiobraVehiculo::class,
            'label' => 'accidente.maniobraVehiculo',
            'placeholder' => 'Seleccione',
            'required' => true,
            'attr' => ['class' => 'simple-select'],
        ]);

        $builder->add('servicioVehiculo', EntityType::class, [
            'class' => ServicioVehiculo::class,
            'label' => 'accidente.servicioVehiculo',
            'placeholder' => 'Seleccione',
            'required' => true,
            'attr' => ['class' => 'simple-select'],
        ]);

        $builder->add('vehiculoEsCausanteProbable', CheckboxType::class, [
            'label' => 'accidente.vehiculoEsCausanteProbable',
            'required' => false,
        ]);

        $builder->add('vehiculoSeFuga', CheckboxType::class, [
            'label' => 'accidente.vehiculoSeFuga',
            'required' => false,
        ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => VehiculoAccidente::class,
        ]);
    }
}
