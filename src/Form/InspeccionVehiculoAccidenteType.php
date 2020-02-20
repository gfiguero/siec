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
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Form\VehiculoType;

class InspeccionVehiculoAccidenteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('vehiculo', VehiculoType::class)
            ->add('consecuenciaVehiculo', EntityType::class, [
                'label' => 'accidente.consecuenciaVehiculo',
                'placeholder' => 'Seleccione',
                'class' => ConsecuenciaVehiculo::class,
                'attr' => [
                    'class' => 'simple-select',
                ],
            ])
            ->add('direccionVehiculo', EntityType::class, [
                'label' => 'accidente.direccionVehiculo',
                'placeholder' => 'Seleccione',
                'class' => DireccionVehiculo::class,
                'attr' => [
                    'class' => 'simple-select',
                ],
            ])
            ->add('maniobraVehiculo', EntityType::class, [
                'label' => 'accidente.maniobraVehiculo',
                'placeholder' => 'Seleccione',
                'class' => ManiobraVehiculo::class,
                'attr' => [
                    'class' => 'simple-select',
                ],
            ])
            ->add('servicioVehiculo', EntityType::class, [
                'label' => 'accidente.servicioVehiculo',
                'placeholder' => 'Seleccione',
                'class' => ServicioVehiculo::class,
                'attr' => [
                    'class' => 'simple-select',
                ],
            ])
            ->add('vehiculoEsCausanteProbable', CheckboxType::class, [
                'label' => 'accidente.vehiculoEsCausanteProbable',
                'required' => false,
            ])
            ->add('vehiculoSeFuga', CheckboxType::class, [
                'label' => 'accidente.vehiculoSeFuga',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => VehiculoAccidente::class,
        ]);
    }
}
