<?php

namespace AppBundle\Form;

use AppBundle\Entity\AnalisisMuestra;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class MuestraType extends AbstractType
{

    protected $muestra;

    public function __construct($muestra)
    {
        $this->muestra = $muestra;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $muestra = $this->muestra;
        $builder
            ->add('noOrden')
            ->add('claveInterna')
            ->add('claveExterna')
            ->add('analisisMuestras', 'entity', array(
                'class' => 'AppBundle:AnalisisMuestra',
                'multiple' => true,
                'query_builder' => function (EntityRepository $er) use ($muestra) {
                    return $er->createQueryBuilder('u')
                        ->where('u.muestra = ?1')
                        ->setParameter(1, $muestra);
                },
            ));
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

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_muestra';
    }
}
