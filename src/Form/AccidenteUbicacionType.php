<?php

namespace App\Form;

use App\Entity\Accidente;
use App\Entity\Comuna;
use App\Entity\Cuadrante;
use App\Entity\TipoZonaAccidente;
use App\Entity\TipoDireccion;
use App\Entity\TipoUbicacionRelativaAccidente;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class AccidenteUbicacionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('comuna', EntityType::class, [
            'class' => Comuna::class,
            'label' => 'accidente.comuna',
            'placeholder' => 'Seleccione',
            'required' => true,
        ]);

        $cuadranteModifier = function (FormInterface $form, Comuna $comuna = null) {
            $cuadrantes = null === $comuna ? [] : $comuna->getCuadrantes();
            $form->add('cuadrante', EntityType::class, [
                'class' => Cuadrante::class,
                'placeholder' => 'Desconocido',
                'choices' => $cuadrantes,
                'required' => false,
            ]);
        };

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($cuadranteModifier) {
                $data = $event->getData();
                $cuadranteModifier($event->getForm(), $data->getComuna());
            }
        );

        $builder->get('comuna')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($cuadranteModifier) {
                $comuna = $event->getForm()->getData();
                $cuadranteModifier($event->getForm()->getParent(), $comuna);
            }
        );

        $builder->add('tipoZonaAccidente', EntityType::class, [
            'class' => TipoZonaAccidente::class,
            'label' => 'accidente.tipoZonaAccidente',
            'placeholder' => 'Seleccione',
            'required' => true,
        ]);

        $claseAccidente = $options['data']->getClaseAccidente();
        $tiposUbicacionRelativaAccidente = null === $claseAccidente ? [] : $claseAccidente->getTiposUbicacionRelativaAccidente();
        $builder->add('tipoUbicacionRelativaAccidente', EntityType::class, [
            'class' => TipoUbicacionRelativaAccidente::class,
            'label' => 'accidente.tipoUbicacionRelativaAccidente',
            'placeholder' => 'Seleccione',
            'required' => true,
            'choices' => $tiposUbicacionRelativaAccidente,
        ]);

        $builder->add('tipoDireccion', EntityType::class, [
            'label' => 'accidente.tipoDireccion',
            'placeholder' => 'Seleccione',
            'class' => TipoDireccion::class,
            'required' => true,
        ]);

        $builder->add('ubicacion', UbicacionAccidenteType::class, [
            'label' => 'accidente.ubicacion',
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
