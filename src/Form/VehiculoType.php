<?php

namespace App\Form;

use App\Entity\Vehiculo;
use App\Entity\TipoVehiculo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class VehiculoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('placaPatenteUnica', TextType::class, [
            'label' => 'vehiculo.placaPatenteUnica',
            'required' => false,
            'attr' => [
                'class' => 'placa-patente',
                'maxlength' => 6,
                'pattern' => '([A-Z]{2}[A-Z0-9]{2}[0-9]{2})',
            ],
        ]);

        $builder->add('marcaVehiculo', TextType::class, [
            'label' => 'vehiculo.marcaVehiculo',
            'required' => false,
            'attr' => ['class' => 'nombre-propio'],
        ]);

        $builder->add('modeloVehiculo', TextType::class, [
            'label' => 'vehiculo.modeloVehiculo',
            'required' => false,
            'attr' => ['class' => 'nombre-propio'],
        ]);

        $builder->add('ano', IntegerType::class, [
            'label' => 'vehiculo.ano',
            'required' => false,
            'attr' => ['min' => '1900', 'max' => '2100']
        ]);

        $builder->add('color', ChoiceType::class, [
            'label' => 'vehiculo.color',
            'placeholder' => 'Seleccione',
            'required' => true,
            'attr' => ['class' => 'simple-select'],
            'choices' => [
                'Desconocido' => 'Desconocido',
                'Blanco' => 'Blanco',
                'Azul' => 'Azul',
                'Rojo' => 'Rojo',
                'Plata' => 'Plata',
                'Negro' => 'Negro',
                'Verde' => 'Verde',
                'Amarillo' => 'Amarillo',
                'Naranja' => 'Naranja',
                'Otro' => 'Otro',
            ]
        ]);

        $builder->add('tipoVehiculo', EntityType::class, [
            'class' => TipoVehiculo::class,
            'label' => 'vehiculo.tipoVehiculo',
            'placeholder' => 'Seleccione',
            'required' => true,
            'attr' => ['class' => 'simple-select'],
        ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Vehiculo::class,
        ]);
    }
}
