<?php

namespace App\Form;

use App\Entity\Region;
use App\Entity\Provincia;
use App\Entity\Comuna;
use App\Entity\Cuadrante;

use App\Entity\Unidad;
use App\Entity\Funcionario;
use App\Entity\Tribunal;

use App\Entity\EstadoAccidente;

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

class FiltroAccidenteUnidadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('idMin', IntegerType::class, ['required' => false,])
            ->add('idMax', IntegerType::class, ['required' => false,])
            ->add('fechaMin', DateType::class, ['required' => false, 'format' => 'dd MM y'])
            ->add('fechaMax', DateType::class, ['required' => false, 'format' => 'dd MM y'])
            ->add('horaMin', TimeType::class, ['required' => false,])
            ->add('horaMax', TimeType::class, ['required' => false,])

// Institucional
            ->add('unidad', EntityType::class, ['label' => 'accidente.unidad', 'required' => false, 'multiple' => true, 'class' => Unidad::class])
            ->add('funcionario', EntityType::class, ['label' => 'accidente.funcionario', 'required' => false, 'multiple' => true, 'class' => Funcionario::class])
            ->add('numeroParte', TextType::class, ['label' => 'accidente.numeroParte', 'required' => false])
            ->add('numeroFormulario', TextType::class, ['label' => 'accidente.numeroFormulario', 'required' => false])
            ->add('esMensaje', CheckboxType::class, ['label' => 'inspeccion.accidente.esMensaje', 'required' => false])
            ->add('concurreSiat', CheckboxType::class, ['label' => 'inspeccion.accidente.concurreSiat', 'required' => false])

// Espacial
            ->add('region', EntityType::class, ['label' => 'accidente.region', 'required' => false, 'multiple' => true, 'class' => Region::class])
            ->add('provincia', EntityType::class, ['label' => 'accidente.provincia', 'required' => false, 'multiple' => true, 'class' => Provincia::class])
            ->add('comuna', EntityType::class, ['label' => 'accidente.comuna', 'required' => false, 'multiple' => true, 'class' => Comuna::class])
            ->add('cuadrante', EntityType::class, ['label' => 'accidente.cuadrante', 'required' => false, 'multiple' => true, 'class' => Cuadrante::class])

// Cualidades de accidente
            ->add('estadoAccidente', EntityType::class, ['label' => 'accidente.estadoAccidente', 'required' => false, 'multiple' => true, 'class' => EstadoAccidente::class])
        ;
    }

    public function getBlockPrefix()
    {
        return 'inspeccion';
    }

}
