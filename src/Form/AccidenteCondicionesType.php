<?php

namespace App\Form;

use App\Entity\Accidente;
use App\Entity\EstadoAtmosferico;
use App\Entity\TipoLuminosidad;
use App\Entity\TipoLuzArtificial;
use App\Entity\EstadoLuzArtificial;
use App\Entity\TipoPavimentoCalzada;
use App\Entity\CondicionPavimentoCalzada;
use App\Entity\EstadoPavimentoCalzada;
use App\Entity\DemarcacionLineaCalzada;
use App\Entity\DemarcacionPrioridadCalzada;
use App\Entity\ElementoCalzada;
use App\Entity\TipoCalzada;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AccidenteCondicionesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('estadoAtmosferico', EntityType::class, [
            'class' => EstadoAtmosferico::class,
            'label' => 'accidente.estadoAtmosferico',
            'placeholder' => 'Seleccione',
            'required' => true,
        ]);

        $builder->add('tipoLuminosidad', EntityType::class, [
            'class' => TipoLuminosidad::class,
            'label' => 'accidente.tipoLuminosidad',
            'placeholder' => 'Seleccione',
            'required' => true,
        ]);

        $builder->add('estadoLuzArtificial', EntityType::class, [
            'class' => EstadoLuzArtificial::class,
            'label' => 'accidente.estadoLuzArtificial',
            'placeholder' => 'Seleccione',
            'required' => true,
        ]);

        $builder->add('tipoPavimentoCalzada', EntityType::class, [
            'class' => TipoPavimentoCalzada::class,
            'label' => 'accidente.tipoPavimentoCalzada',
            'placeholder' => 'Seleccione',
            'required' => true,
        ]);

        $builder->add('condicionPavimentoCalzada', EntityType::class, [
            'class' => CondicionPavimentoCalzada::class,
            'label' => 'accidente.condicionPavimentoCalzada',
            'placeholder' => 'Seleccione',
            'required' => true,
        ]);

        $builder->add('estadoPavimentoCalzada', EntityType::class, [
            'class' => EstadoPavimentoCalzada::class,
            'label' => 'accidente.estadoPavimentoCalzada',
            'placeholder' => 'Seleccione',
            'required' => true,
        ]);

        $builder->add('demarcacionPrioridadCalzada', EntityType::class, [
            'class'    => DemarcacionPrioridadCalzada::class,
            'label' => 'accidente.demarcacionPrioridadCalzada',
            'placeholder' => 'Seleccione',
            'required' => true,
        ]);

        $builder->add('demarcacionLineaCalzada', EntityType::class, [
            'class' => DemarcacionLineaCalzada::class,
            'label' => 'accidente.demarcacionLineaCalzada',
            'placeholder' => 'Seleccione',
            'required' => true,
        ]);

        $builder->add('elementosCalzada', EntityType::class, [
            'class' => ElementoCalzada::class,
            'label' => 'accidente.elementosCalzada',
            'placeholder' => 'Seleccione',
            'multiple' => true,
            'expanded' => true,
        ]);

        $builder->add('tipoCalzada', EntityType::class, [
            'class' => TipoCalzada::class,
            'label' => 'accidente.tipoCalzada',
            'placeholder' => 'Seleccione',
            'required' => true,
        ]);

        $builder->add('cantidadPistasIda', ChoiceType::class, [
            'label' => 'accidente.cantidadPistasIda',
            'placeholder' => 'Seleccione',
            'required' => true,
            'choices'  => [
                '1 Pista'  => '1',
                '2 Pistas' => '2',
                '3 Pistas' => '3',
                '4 Pistas' => '4',
                '5 Pistas' => '5',
                '6 Pistas' => '6',
                '7 Pistas' => '7',
                '8 Pistas' => '8',
                '9 Pistas' => '9',
            ],
        ]);

        $builder->add('cantidadPistasRegreso', ChoiceType::class, [
            'label' => 'accidente.cantidadPistasRegreso',
            'placeholder' => 'Seleccione',
            'required' => true,
            'choices'  => [
                'Sin pista de regreso' => '0',
                '1 Pista'  => '1',
                '2 Pistas' => '2',
                '3 Pistas' => '3',
                '4 Pistas' => '4',
                '5 Pistas' => '5',
                '6 Pistas' => '6',
                '7 Pistas' => '7',
                '8 Pistas' => '8',
                '9 Pistas' => '9',
            ],
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
