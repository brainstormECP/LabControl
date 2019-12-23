<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ExperimentoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fechaInicio', 'date', array(
                'input' => 'datetime',
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy'
            ))
            ->add('fechaFin', 'date', array(
                'input' => 'datetime',
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy'
            ))
            ->add('observaciones')
            ->add('actividadCientifica')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Experimento'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_experimento';
    }
}
