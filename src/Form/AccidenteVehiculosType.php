<?php

namespace App\Form;

use App\Entity\Accidente;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class AccidenteVehiculosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('vehiculosAccidente', CollectionType::class, [
            'entry_type'   => VehiculoAccidenteType::class,
            'label'        => false,
            'by_reference' => false,
            'allow_add'    => true,
            'allow_delete' => true,
            'prototype'    => true,
            'required'     => true,
            'attr'         => ['class' => "vehiculo-collection"],
        ]);
    }

    public function getBlockPrefix()
    {
        return 'accidente';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Accidente::class,
        ]);
    }
}
