<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MuestraType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('NoOrden')
            ->add('ClaveInterna')
            ->add('ClaveExterna')
            ->add('Experimento')
            ->add('Tratamientos')
            ->add('Especie')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Muestra'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_muestra';
    }
}
