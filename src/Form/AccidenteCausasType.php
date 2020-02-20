<?php

namespace App\Form;

use App\Entity\Accidente;
use App\Entity\Causa;
use App\Entity\CausaBasal;
use App\Repository\CausaRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class AccidenteCausasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder->add('causaBasal', EntityType::class, [
            'class' => Causa::class,
            'label' => 'accidente.causaBasal',
            'placeholder' => 'Seleccione',
        ]);

        $causasModifier = function (FormInterface $form, Causa $causaBasal = null) {
            $form->add('causas', EntityType::class, [
                'class' => Causa::class,
                'label' => 'accidente.causas',
                'placeholder' => 'Seleccione',
                'required' => false,
                'multiple' => true,
                'query_builder' => function (CausaRepository $repository) use ($causaBasal) {
                    return $repository->causasConcurrentes($causaBasal);
                },
                'attr' => ['class' => 'multiple-select'],
            ]);
        };

        $builder->get('causaBasal')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($causasModifier) {
                $causaBasal = $event->getForm()->getData();
                $causasModifier($event->getForm()->getParent(), $causaBasal);
            }
        );

        $builder->get('causaBasal')->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($causasModifier) {
                $causaBasal = $event->getData();
                $causasModifier($event->getForm()->getParent(), $causaBasal);
            }
        );

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
