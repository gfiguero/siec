<?php

namespace App\Form;

use App\Entity\Causa;
use App\Entity\ClaseAccidente;
use App\Entity\TipoAccidente;
use App\Entity\Funcionario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class AccidenteBusquedaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('numeroFormulario', TextType::class, [
            'label' => 'accidente.numeroFormulario',
            'required' => false,
        ]);

        $builder->add('numeroParte', null, [
            'label' => 'accidente.numeroParte',
            'required' => false,
        ]);

        $builder->add('causaBasal', EntityType::class, [
            'class' => Causa::class,
            'label' => 'accidente.causaBasal',
            'placeholder' => 'Seleccione',
            'required' => false,
            'multiple' => true,
        ]);

        $builder->add('claseAccidente', EntityType::class, [
            'class' => ClaseAccidente::class,
            'label' => 'accidente.claseAccidente',
            'placeholder' => 'Seleccione',
            'required' => false,
            'multiple' => true,
        ]);

        $builder->add('tipoAccidente', EntityType::class, [
            'class' => TipoAccidente::class,
            'label' => 'accidente.tipoAccidente',
            'placeholder' => 'Seleccione',
            'required' => false,
            'multiple' => true,
        ]);

        $funcionarios = null === $options['unidad'] ? [] : $options['unidad']->getFuncionarios();

        $builder->add('funcionario', EntityType::class, [
            'class' => Funcionario::class,
            'label' => 'accidente.funcionario',
            'placeholder' => 'Seleccione',
            'required' => false,
            'multiple' => true,
            'choices' => $funcionarios,
        ]);

        $builder->add('funcionarioResponsable', EntityType::class, [
            'class' => Funcionario::class,
            'label' => 'accidente.funcionarioResponsable',
            'placeholder' => 'Seleccione',
            'required' => false,
            'multiple' => true,
            'choices' => $funcionarios,
        ]);

        $builder->add('fechaInicio', DateType::class, [
            'label' => 'accidente.fechaInicio',
            'required' => false,
            'format' => 'dd MM y'
        ]);

        $builder->add('fechaFin', DateType::class, [
            'label' => 'accidente.fechaFin',
            'required' => false,
            'format' => 'dd MM y'
        ]);

        $builder->add('esMensaje', CheckboxType::class, [
            'label' => 'accidente.esMensaje',
            'required' => false,
            'label' => 'Sólo mensajes',
        ]);

        $builder->add('buscar', SubmitType::class, [
            'label' => 'Buscar'
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'unidad' => null,
        ]);
    }
}
