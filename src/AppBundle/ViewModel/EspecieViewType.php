<?php

namespace AppBundle\ViewModel;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EspecieViewType extends AbstractType
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
            ->add('especie', 'entity', array(
                'class' => 'AppBundle:Especie',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u');
                },
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\ViewModel\EspecieView'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'especie';
    }
}
