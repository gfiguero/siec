<?php

namespace App\Form;

use App\Entity\Accidente;
use App\Entity\Unidad;
use App\Entity\Comuna;
use App\Entity\Causa;
use App\Entity\ClaseAccidente;
use App\Entity\TipoAccidente;
use App\Entity\TipoDireccion;
use App\Entity\TipoZonaAccidente;
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
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class MensajeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('fecha', DateType::class, [
            'label' => 'accidente.fecha',
            'required' => true,
        ]);

        $builder->add('hora', TimeType::class, [
            'label' => 'accidente.hora',
            'required' => true,
        ]);


        $builder->add('numeroParte', TextType::class, [
            'label' => 'mensaje.numeroParte',
            'required' => true,
            'attr' => ['maxlength' => '15','pattern' => '(\d*)'],
        ]);

        $builder->add('cantidadFallecidos', IntegerType::class, [
            'label' => 'mensaje.cantidadFallecidos',
            'required' => true,
            'attr' => ['min' => '1']
        ]);

        $builder->add('claseAccidente', EntityType::class, [
            'class' => ClaseAccidente::class,
            'label' => 'mensaje.claseAccidente',
            'placeholder' => 'Seleccione',
            'required' => true,
        ]);

        $tipoAccidenteModifier = function (FormInterface $form, ClaseAccidente $claseAccidente = null) {
            $tiposAccidente = null === $claseAccidente ? [] : $claseAccidente->getTiposAccidente();
            $form->add('tipoAccidente', EntityType::class, [
                'class' => TipoAccidente::class,
                'label' => 'mensaje.tipoAccidente',
                'placeholder' => 'Seleccione clase',
                'required' => true,
                'choices' => $tiposAccidente,
            ]);
        };

        $builder->get('claseAccidente')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($tipoAccidenteModifier) {
                $claseAccidente = $event->getForm()->getData();
                $tipoAccidenteModifier($event->getForm()->getParent(), $claseAccidente);
            }
        );

        $builder->get('claseAccidente')->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($tipoAccidenteModifier) {
                $claseAccidente = $event->getData();
                $tipoAccidenteModifier($event->getForm()->getParent(), $claseAccidente);
            }
        );

        $builder->add('causaBasal', EntityType::class, [
            'class' => Causa::class,
            'label' => 'mensaje.causaBasal',
            'placeholder' => 'Seleccione',
            'required' => true,
        ]);

        $builder->add('comuna', EntityType::class, [
            'class' => Comuna::class,
            'label' => 'mensaje.comuna',
            'placeholder' => 'Seleccione',
            'required' => true,
        ]);

        $unidadModifier = function (FormInterface $form, Comuna $comuna = null) {
            $unidades = null === $comuna ? [] : $comuna->getUnidades();
            $form->add('unidad', EntityType::class, [
                'class' => Unidad::class,
                'label' => 'mensaje.unidad',
                'placeholder' => 'Seleccione comuna',
                'required' => true,
                'choices' => $unidades,
            ]);
        };

        $builder->get('comuna')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($unidadModifier) {
                $comuna = $event->getForm()->getData();
                $unidadModifier($event->getForm()->getParent(), $comuna);
            }
        );

        $builder->get('comuna')->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($unidadModifier) {
                $comuna = $event->getData();
                $unidadModifier($event->getForm()->getParent(), $comuna);
            }
        );

        $builder->add('tipoZonaAccidente', EntityType::class, [
            'class' => TipoZonaAccidente::class,
            'label' => 'mensaje.tipoZonaAccidente',
            'placeholder' => 'Seleccione',
            'required' => true,
        ]);

        $builder->add('tipoDireccion', EntityType::class, [
            'class' => TipoDireccion::class,
            'label' => 'mensaje.tipoDireccion',
            'placeholder' => 'Seleccione',
            'required' => true,
        ]);

        $builder->add('ubicacion', UbicacionAccidenteType::class);
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
