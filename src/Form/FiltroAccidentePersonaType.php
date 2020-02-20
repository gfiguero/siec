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

use App\Entity\ClaseLicencia;
use App\Entity\CondicionFisica;
use App\Entity\ConsecuenciaPersona;
use App\Entity\CualidadEspecial;
use App\Entity\TipoTrayecto;
use App\Entity\SeguridadPersona;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class FiltroAccidentePersonaType extends AbstractType
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

        // Cualidades personales
            ->add('claseLicencia', EntityType::class, ['label' => 'inspeccion.persona.claseLicencia', 'required' => false, 'multiple' => true, 'class' => ClaseLicencia::class])
            ->add('comunaLicencia', EntityType::class, ['label' => 'inspeccion.persona.comunaLicencia', 'required' => false, 'multiple' => true, 'class' => Comuna::class])
            ->add('condicionFisica', EntityType::class, ['label' => 'inspeccion.persona.condicionFisica', 'required' => false, 'multiple' => true, 'class' => CondicionFisica::class])
            ->add('consecuenciaPersona', EntityType::class, ['label' => 'inspeccion.persona.consecuenciaPersona', 'required' => false, 'multiple' => true, 'class' => ConsecuenciaPersona::class])
            ->add('cualidadEspecial', EntityType::class, ['label' => 'inspeccion.persona.cualidadEspecial', 'required' => false, 'multiple' => true, 'class' => CualidadEspecial::class])
            ->add('tipoTrayecto', EntityType::class, ['label' => 'inspeccion.persona.tipoTrayecto', 'required' => false, 'multiple' => true, 'class' => TipoTrayecto::class])
            ->add('seguridad', EntityType::class, ['label' => 'inspeccion.persona.seguridad', 'required' => false, 'multiple' => true, 'class' => SeguridadPersona::class])
        ;
    }

    public function getBlockPrefix()
    {
        return 'inspeccion';
    }

}
