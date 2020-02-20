<?php

namespace App\Form;

use App\Entity\Unidad;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UnidadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('codigo')
            ->add('habilitada')
            ->add('claseUnidad')
            ->add('comuna')
            ->add('tipoUnidad')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Unidad::class,
        ]);
    }
}
