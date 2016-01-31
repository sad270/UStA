<?php

namespace USTA\MemberBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
//Type
use \USTA\MemberBundle\Form\Type\AddressTypeType;
use \Symfony\Component\Form\Extension\Core\Type\TextareaType;
use \Symfony\Component\Form\Extension\Core\Type\TextType;

class AddressType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', AddressTypeType::class, array(
              'label' => 'Type',
            ))
            ->add('address', TextareaType::class, array(
              'label' => 'Adresse',
              'attr' => array('placeholder' => '42bis rue Lorem Ipsum
Appt 2 Porte 2'),
            ))
            ->add('zipcode', TextType::class, array(
              'label' => 'Code Postal',
              'attr' => array('placeholder' => '33000'),
            ))
            ->add('city', TextType::class, array(
              'label' => 'Ville',
              'attr' => array('placeholder' => 'VILLE'),
            ))
            ->add('country', TextType::class, array(
              'label' => 'Pays',
              'attr' => array('placeholder' => 'PAYS'),
            ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'USTA\MemberBundle\Entity\Address'
        ));
    }

}
