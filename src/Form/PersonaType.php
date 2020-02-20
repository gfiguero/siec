<?php

namespace App\Form;

use App\Entity\Persona;
use App\Entity\Nacionalidad;
use App\Entity\EstadoCivil;
use App\Validator\Rut;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\NotBlank;

class PersonaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('run', TextType::class, [
                'label' => 'persona.run',
                'attr' => [ 'class' => 'rut' ],
                'constraints' => array(new Rut()),
                'required' => false,
            ])
            ->add('nombres', TextType::class, [
                'label' => 'persona.nombres',
                'attr' => [ 'class' => 'nombre-propio' ],
                'required' => false,
            ])
            ->add('apellidoPaterno', TextType::class, [
                'label' => 'persona.apellidoPaterno',
                'attr' => [ 'class' => 'nombre-propio' ],
                'required' => false,
            ])
            ->add('apellidoMaterno', TextType::class, [
                'label' => 'persona.apellidoMaterno',
                'attr' => [ 'class' => 'nombre-propio' ],
                'required' => false,
            ])
            ->add('ocupacion', TextType::class, [
                'label' => 'persona.ocupacion',
                'attr' => [ 'class' => 'nombre-propio' ],
                'required' => false,
            ])
            ->add('lugarNacimiento', TextType::class, [
                'label' => 'persona.lugarNacimiento',
                'attr' => [ 'class' => 'nombre-propio' ],
                'required' => false,
            ])
            ->add('fechaNacimiento', BirthdayType::class, [
                'label' => 'persona.fechaNacimiento',
            ])
            ->add('genero', ChoiceType::class, [
                'label' => 'persona.genero',
                'choices' => [
                    'No determinado' => 'No determinado',
                    'Masculino' => 'Masculino',
                    'Femenino' => 'Femenino',
                ],
                'attr' => [ 'class' => 'simple-select' ],
                'placeholder' => 'Seleccione',
                'required' => true,
            ])
            ->add('estadoCivil', ChoiceType::class, [
                'label' => 'persona.estadoCivil',
                'choices' => [
                    'No determinado' => 'No determinado',
                    'Soltero(a)' => 'Soltero(a)',
                    'Casado(a)' => 'Casado(a)',
                    'Divorciado(a)' => 'Divorciado(a)',
                    'Viudo(a)' => 'Viudo(a)',
                ],
                'attr' => [ 'class' => 'simple-select' ],
                'placeholder' => 'Seleccione',
                'required' => true,
            ])
            ->add('nacionalidad', ChoiceType::class, [
                'label' => 'persona.nacionalidad',
                'choices' => [
                    'No determinada' => 'No determinada',
                    'Chilena' => 'Chilena',
                    'Venezolana' => 'Venezolana',
                    'Peruana' => 'Peruana',
                    'Haitiana' => 'Haitiana',
                    'Colombiana' => 'Colombiana',
                    'Boliviana' => 'Boliviana',
                    'Argentina' => 'Argentina',
                    'Ecuatoriana' => 'Ecuatoriana',
                    'Española' => 'Española',
                    'Brasileña' => 'Brasileña',
                    'Dominicana' => 'Dominicana',
                    'Estadounidense' => 'Estadounidense',
                    'Cuabana' => 'Cuabana',
                    'China' => 'China',
                    'Mejicana' => 'Mejicana',
                    'Alemana' => 'Alemana',
                    'Otra latinoamericana' => 'Otra latinoamericana',
                    'Otra norteamericana' => 'Otra norteamericana',
                    'Otra europea' => 'Otra europea',
                    'Otra del mundo' => 'Otra del mundo',
                ],
                'attr' => [ 'class' => 'simple-select' ],
                'placeholder' => 'Seleccione',
                'required' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Persona::class,
        ]);
    }
}
