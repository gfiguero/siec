<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ExportarAccidenteUnidadType extends AbstractType
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
            ->add('region', CheckboxType::class, ['label' => 'accidente.region', 'required' => false, 'attr' => ['checked' => 'checked']])

            ->add('glosa', CheckboxType::class, ['label' => 'accidente.glosa', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('calle', CheckboxType::class, ['label' => 'accidente.calle', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('numero', CheckboxType::class, ['label' => 'accidente.numero', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('direccion', CheckboxType::class, ['label' => 'accidente.direccion', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('latitud', CheckboxType::class, ['label' => 'accidente.latitud', 'required' => false])
            ->add('longitud', CheckboxType::class, ['label' => 'accidente.longitud', 'required' => false])

            ->add('unidad', CheckboxType::class, ['label' => 'accidente.unidad', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('funcionario', CheckboxType::class, ['label' => 'accidente.funcionario', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('numeroParte', CheckboxType::class, ['label' => 'accidente.numeroParte', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('numeroFormulario', CheckboxType::class, ['label' => 'accidente.numeroFormulario', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('esMensaje', CheckboxType::class, ['label' => 'accidente.esMensaje', 'required' => false, 'attr' => ['checked' => 'checked']])
            ->add('concurreSiat', CheckboxType::class, ['label' => 'accidente.concurreSiat', 'required' => false, 'attr' => ['checked' => 'checked']])

            ->add('estadoAccidente', CheckboxType::class, ['label' => 'accidente.estadoAccidente', 'required' => false])

            ->add('submit', SubmitType::class, ['label' => 'exportacion.accidente.submit', 'attr' => ['class' => 'btn btn-primary btn-lg btn-block']])
        ;
    }

    public function getBlockPrefix()
    {
        return 'exportar';
    }

}
