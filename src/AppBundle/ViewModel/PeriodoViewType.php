<?php

namespace AppBundle\ViewModel;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PeriodoViewType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fechaInicio','date',array(
                'input' => 'datetime',
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy'
            ))
            ->add('fechaFin','date',array(
                'input' => 'datetime',
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy'
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\ViewModel\PeriodoView'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'fecha';
    }
}
