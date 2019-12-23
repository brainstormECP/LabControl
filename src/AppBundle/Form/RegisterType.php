<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegisterType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('username')
            ->add('email')
            ->add('institucion', 'entity', array(
                'class' => 'AppBundle:Institucion',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->select('u');
                },
            ))
            ->add('password', 'repeated', array(
                'type' => 'password',
                'invalid_message' => 'La contraseña y la confirmación no coinciden.',
                'options' => array('attr' => array('class' => 'password-field')),
                'required' => true,
                'first_options'  => array('label' => 'Contraseña'),
                'second_options' => array('label' => 'Confirmar contraseña')))
            ->add('captcha', 'captcha', array(
                'as_url' => true,
                'reload' => true,
                'invalid_message' => 'Ha escrito el texto mal, vuelva a intentarlo.'
            ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\ViewModel\Register'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_register';
    }
}
