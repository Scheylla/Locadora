<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type as FormType;

class ClienteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome', FormType\TextType::class, array(
                'attr' => array(
                    'maxlength' => 200,
                    'min' => 6
                    )
            ))
            ->add('endereco', FormType\TextType::class)
            ->add('email', FormType\TextType::class)
            ->add('dataNascimento', FormType\BirthdayType::class, array(
                'format'=> 'dd/MM/yyyy'
            ))
        ;
    }
    
    //MMMM nome dos meses, MMM abreviação
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Cliente'
        ));
    }
}
