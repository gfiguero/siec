<?php

namespace App\Form;

use App\Entity\Region;
use App\Entity\Provincia;
use App\Entity\Comuna;
use App\Entity\Cuadrante;

use App\Entity\ClaseAccidente;
use App\Entity\TipoAccidente;
use App\Entity\TipoCausa;
use App\Entity\Causa;

use App\Entity\TipoVehiculo;
use App\Entity\ServicioVehiculo;
use App\Entity\ManiobraVehiculo;
use App\Entity\DireccionVehiculo;
use App\Entity\ConsecuenciaVehiculo;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class FiltroAccidenteVehiculoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

        // Temporal
            ->add('fechaMin', DateType::class, ['required' => false, 'format' => 'dd MM y'])
            ->add('fechaMax', DateType::class, ['required' => false, 'format' => 'dd MM y'])
            ->add('horaMin', TimeType::class, ['required' => false])
            ->add('horaMax', TimeType::class, ['required' => false])

        // Territorial
            ->add('region', EntityType::class, ['label' => 'inspeccion.accidente.region', 'required' => false, 'multiple' => true, 'class' => Region::class])
            ->add('provincia', EntityType::class, ['label' => 'inspeccion.accidente.provincia', 'required' => false, 'multiple' => true, 'class' => Provincia::class])
            ->add('comuna', EntityType::class, ['label' => 'inspeccion.accidente.comuna', 'required' => false, 'multiple' => true, 'class' => Comuna::class])
            ->add('cuadrante', EntityType::class, ['label' => 'inspeccion.accidente.cuadrante', 'required' => false, 'multiple' => true, 'class' => Cuadrante::class])

        // Cualidades de accidente
            ->add('claseAccidente', EntityType::class, ['label' => 'inspeccion.accidente.claseAccidente', 'required' => false, 'multiple' => true, 'class' => ClaseAccidente::class])
            ->add('tipoAccidente', EntityType::class, ['label' => 'inspeccion.accidente.tipoAccidente', 'required' => false, 'multiple' => true, 'class' => TipoAccidente::class])
            ->add('tipoCausa', EntityType::class, ['label' => 'inspeccion.accidente.tipoCausa', 'required' => false, 'multiple' => true, 'class' => TipoCausa::class])
            ->add('causaBasal', EntityType::class, ['label' => 'inspeccion.accidente.causaBasal', 'required' => false, 'multiple' => true, 'class' => Causa::class])

        // Vehicular
            ->add('tipoVehiculo', EntityType::class, ['label' => 'inspeccion.vehiculo.tipoVehiculo', 'required' => false, 'multiple' => true, 'placeholder' => 'Seleccione', 'class' => TipoVehiculo::class])
            ->add('servicioVehiculo', EntityType::class, ['label' => 'inspeccion.vehiculo.servicioVehiculo', 'required' => false, 'multiple' => true, 'placeholder' => 'Seleccione', 'class' => ServicioVehiculo::class])
            ->add('maniobraVehiculo', EntityType::class, ['label' => 'inspeccion.vehiculo.maniobraVehiculo', 'required' => false, 'multiple' => true, 'placeholder' => 'Seleccione', 'class' => ManiobraVehiculo::class])
            ->add('direccionVehiculo', EntityType::class, ['label' => 'inspeccion.vehiculo.direccionVehiculo', 'required' => false, 'multiple' => true, 'placeholder' => 'Seleccione', 'class' => DireccionVehiculo::class])
            ->add('consecuenciaVehiculo', EntityType::class, ['label' => 'inspeccion.vehiculo.consecuenciaVehiculo', 'required' => false, 'multiple' => true, 'placeholder' => 'Seleccione', 'class' => ConsecuenciaVehiculo::class])

        // Final
            ->add('submit', SubmitType::class, ['label' => 'Buscar'])
        ;
    }

    public function getBlockPrefix()
    {
        return 'inspeccion';
    }

}
