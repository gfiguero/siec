<?php

namespace App\Form;

use App\Entity\UbicacionAccidente;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;

class UbicacionAccidenteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('glosa', TextType::class, [
            'label' => 'ubicacion.glosa',
            'required' => true,
            'attr' => ['placeholder' => 'Buscar / Calle número / Calle con calle / Ruta kilómetro', 'maxlength' => '150'],
        ]);

        $builder->add('maestroId', HiddenType::class, [
            'label' => 'ubicacion.maestroId',
            'required' => false,
        ]);

        $builder->add('comuna', HiddenType::class, [
            'label' => 'ubicacion.comuna',
            'required' => false,
        ]);

        $builder->add('tipoId', HiddenType::class, [
            'label' => 'ubicacion.tipoId',
            'required' => false,
        ]);

        $builder->add('tipo', HiddenType::class, [
            'label' => 'ubicacion.tipo',
            'required' => false,
        ]);

        $builder->add('pais', HiddenType::class, [
            'label' => 'ubicacion.pais',
            'required' => false,
        ]);

        $builder->add('calle', TextType::class, [
            'label' => 'ubicacion.calle',
            'required' => false,
            'attr' => ['readonly' => 'readonly'],
        ]);

        $builder->add('numero', TextType::class, [
            'label' => 'ubicacion.numero',
            'required' => false,
            'attr' => ['readonly' => 'readonly'],
        ]);

        $builder->add('direccion', TextType::class, [
            'label' => 'ubicacion.direccion',
            'required' => false,
            'attr' => ['readonly' => 'readonly'],
        ]);

        $builder->add('latitud', TextType::class, [
            'label' => 'ubicacion.latitud',
            'required' => true,
            'attr' => ['placeholder' => 'Selecciona un punto'],
        ]);

        $builder->add('longitud', TextType::class, [
            'label' => 'ubicacion.longitud',
            'required' => true,
            'attr' => ['placeholder' => 'Selecciona un punto'],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UbicacionAccidente::class,
        ]);
    }
}
