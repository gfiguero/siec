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

class PersonaAccidenteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('persona', PersonaType::class)
            ->add('claseLicencia', EntityType::class, [
                'placeholder' => 'Seleccione',
                'label' => 'Clase licencia',
                'class' => ClaseLicencia::class,
                'attr' => [
                    'class' => 'simple-select',
                ],
            ])
            ->add('comunaLicencia', EntityType::class, [
                'placeholder' => 'Sin licencia',
                'label' => 'Comuna licencia',
                'class' => Comuna::class,
                'attr' => [
                    'class' => 'simple-select',
                ],
            ])
            ->add('tipoTrayecto', EntityType::class, [
                'placeholder' => 'Seleccione',
                'label' => 'Tipo trayecto',
                'class' => TipoTrayecto::class,
                'attr' => [
                    'class' => 'simple-select',
                ],
            ])
            ->add('condicionFisica', EntityType::class, [
                'placeholder' => 'Seleccione',
                'label' => 'Condición física',
                'class' => CondicionFisica::class,
                'attr' => [
                    'class' => 'simple-select',
                ],
            ])
            ->add('cualidadEspecial', EntityType::class, [
                'placeholder' => 'Seleccione',
                'label' => 'Cualidad especial',
                'class' => CualidadEspecial::class,
                'attr' => [
                    'class' => 'simple-select',
                ],
            ])
            ->add('consecuenciaPersona', EntityType::class, [
                'placeholder' => 'Seleccione',
                'label' => 'Consecuencia',
                'class' => ConsecuenciaPersona::class,
                'attr' => [
                    'class' => 'simple-select',
                ],
            ])
            ->add('calidadPersona', EntityType::class, [
                'placeholder' => 'Seleccione',
                'label' => 'Calidad',
                'class' => CalidadPersona::class,
                'attr' => [
                    'class' => 'simple-select',
                ],
            ])
            ->add('personaEsCausanteProbable', CheckboxType::class, [
                'label'    => 'Es causante probable',
                'required' => false,
            ])
            ->add('seguridad', EntityType::class, [
                'label' => 'Seguridad',
                'required'   => false,
                'class' => SeguridadPersona::class,
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('personaSeFuga', CheckboxType::class, [
                'label'    => 'Se da a la fuga',
                'required' => false,
            ])
            ->add('edad')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PersonaAccidente::class,
        ]);
    }

}
