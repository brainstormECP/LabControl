<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PastoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tipoEstudio')
            ->add('noOrden')
            ->add('claveInterna')
            ->add('claveExterna')
            ->add('especie')
            ->add('genero')
            ->add('clasificacion')
            ->add('experimento')
            ->add('tratamientos')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Pasto'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_pasto';
    }
}
