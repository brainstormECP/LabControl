<?php
/**
 * Created by PhpStorm.
 * User: Elvis
 * Date: 09/10/2015
 * Time: 05:41:PM
 */

namespace AppBundle\ViewModel;


use AppBundle\Form\TratamientoType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class PastoViewType extends AbstractType
{

    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $this->user;
        $builder
            ->add('especie', 'entity', array(
                'class' => 'AppBundle:Especie',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->select('u');
                },
            ))
            ->add('experimento', 'entity', array(
                'class' => 'AppBundle:Experimento',
                'query_builder' => function (EntityRepository $er) use ($user) {
                    return $er->createQueryBuilder('u')
                        ->where('u.investigador = ?1')
                        ->setParameter(1, $user);
                },
            ))
            ->add('tipoEstudio', 'choice', array(
                'placeholder' => 'Seleccione ...',
                'choices' => array(
                    'Agronómicos' => 'Agronómicos',
                    'Nutrición animal' => 'Nutrición animal',
                ),
                'required' => true,
            ))
            ->add('dias','integer')
            ->add('epoca', 'choice', array(
                'placeholder' => 'Seleccione ...',
                'choices' => array(
                    'Seca' => 'Seca',
                    'Lluvia' => 'Lluvia',
                ),
                'required' => true,
            ))
            ->add('tratamientos','collection',array(
                'type' => new TratamientoType(),
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
            ))
            ->add('analisis', 'entity', array(
                'class' => 'AppBundle:Analisis',
                'multiple' => true,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->select('u');
                },
            ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\ViewModel\PastoView'
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
        return 'appbundle_pastoview';
    }
}
