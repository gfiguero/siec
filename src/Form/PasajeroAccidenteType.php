<?php

namespace App\Form;

use App\Entity\PersonaAccidente;
use App\Entity\ClaseLicencia;
use App\Entity\Comuna;
use App\Entity\TipoTrayecto;
use App\Entity\CondicionFisica;
use App\Entity\CualidadEspecial;
use App\Entity\ConsecuenciaPersona;
use App\Entity\CalidadPersona;
use App\Entity\SeguridadPersona;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Form\PersonaType;

class PasajeroAccidenteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('persona', PersonaType::class, [
            'label' => null,
            'required' => true,
        ]);

        $builder->add('personaEsCausanteProbable', CheckboxType::class, [
            'label' => 'accidente.personaEsCausanteProbable',
            'required' => false,
        ]);

        $builder->add('personaSeFuga', CheckboxType::class, [
            'label' => 'accidente.personaSeFuga',
            'required' => false,
        ]);

        $builder->add('tipoTrayecto', EntityType::class, [
            'class' => TipoTrayecto::class,
            'label' => 'accidente.tipoTrayecto',
            'placeholder' => 'Seleccione',
            'required' => true,
            'attr' => ['class' => 'simple-select'],
        ]);

        $builder->add('condicionFisica', EntityType::class, [
            'class' => CondicionFisica::class,
            'label' => 'accidente.condicionFisica',
            'placeholder' => 'Seleccione',
            'required' => true,
            'attr' => ['class' => 'simple-select'],
        ]);

        $builder->add('cualidadEspecial', EntityType::class, [
            'class' => CualidadEspecial::class,
            'label' => 'accidente.cualidadEspecial',
            'placeholder' => 'Seleccione',
            'required' => true,
            'attr' => ['class' => 'simple-select'],
        ]);

        $builder->add('consecuenciaPersona', EntityType::class, [
            'class' => ConsecuenciaPersona::class,
            'label' => 'accidente.consecuenciaPersona',
            'placeholder' => 'Seleccione',
            'required' => true,
            'attr' => ['class' => 'simple-select'],
        ]);

        $builder->add('seguridad', EntityType::class, [
            'class' => SeguridadPersona::class,
            'label' => 'accidente.seguridad',
            'required' => false,
            'multiple' => true,
            'expanded' => true,
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PersonaAccidente::class,
        ]);
    }

}
