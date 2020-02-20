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

class InspeccionConductorAccidenteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('persona', PersonaType::class)
            ->add('claseLicencia', EntityType::class, [
                'label' => 'accidente.claseLicencia',
                'placeholder' => 'Seleccione',
                'class' => ClaseLicencia::class,
                'attr' => [
                    'class' => 'simple-select',
                ],
            ])
            ->add('comunaLicencia', EntityType::class, [
                'label' => 'accidente.comunaLicencia',
                'placeholder' => 'Seleccione',
                'class' => Comuna::class,
                'attr' => [
                    'class' => 'simple-select',
                ],
            ])
            ->add('tipoTrayecto', EntityType::class, [
                'label' => 'accidente.tipoTrayecto',
                'placeholder' => 'Seleccione',
                'class' => TipoTrayecto::class,
                'attr' => [
                    'class' => 'simple-select',
                ],
            ])
            ->add('condicionFisica', EntityType::class, [
                'label' => 'accidente.condicionFisica',
                'placeholder' => 'Seleccione',
                'class' => CondicionFisica::class,
                'attr' => [
                    'class' => 'simple-select',
                ],
            ])
            ->add('cualidadEspecial', EntityType::class, [
                'label' => 'accidente.cualidadEspecial',
                'placeholder' => 'Seleccione',
                'class' => CualidadEspecial::class,
                'attr' => [
                    'class' => 'simple-select',
                ],
            ])
            ->add('consecuenciaPersona', EntityType::class, [
                'label' => 'accidente.consecuenciaPersona',
                'placeholder' => 'Seleccione',
                'class' => ConsecuenciaPersona::class,
                'attr' => [
                    'class' => 'simple-select',
                ],
            ])
            ->add('personaEsCausanteProbable', CheckboxType::class, [
                'label' => 'accidente.personaEsCausanteProbable',
                'required' => false,
            ])
            ->add('personaSeFuga', CheckboxType::class, [
                'label' => 'accidente.personaSeFuga',
                'required' => false,
            ])
            ->add('seguridad', EntityType::class, [
                'label' => 'accidente.seguridad',
                'required' => false,
                'class' => SeguridadPersona::class,
                'multiple' => true,
                'expanded' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PersonaAccidente::class,
        ]);
    }

}
