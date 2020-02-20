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
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class AccidenteIdentificacionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('numeroParte', TextType::class, [
            'label' => 'accidente.numeroParte',
            'required' => true,
            'attr' => ['maxlength' => '15','pattern' => '(\d*)'],
        ]);

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

        $builder->add('concurreSiat', CheckboxType::class, [
            'label' => 'accidente.concurreSiat',
            'required' => false,
        ]);

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
                'choices' => $tiposAccidente,
                'required' => true,
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

        $unidad = null === $options['data'] ? [] : $options['data']->getUnidad();

        $funcionarios = null === $unidad ? [] : $unidad->getFuncionarios();

        $builder->add('funcionario', EntityType::class, [
            'class' => Funcionario::class,
            'label' => 'accidente.funcionario',
            'placeholder' => 'Seleccione',
            'required' => true,
            'choices' => $funcionarios,
        ]);

        $builder->add('tribunal', EntityType::class, [
            'class' => Tribunal::class,
            'label' => 'accidente.tribunal',
            'placeholder' => 'Seleccione',
            'required' => true,
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
