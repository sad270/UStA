<?php

namespace USTA\MemberBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
//Type
use \USTA\MemberBundle\Form\Type\PhoneTypeType;
use \Symfony\Component\Form\Extension\Core\Type\TextType;

class PhoneType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', PhoneTypeType::class, array(
              'label' => 'Type',
            ))
            ->add('num', TextType::class, array(
              'label' => 'Numéro',
              'attr' => array('placeholder' => '0611223344'),
            ))
            ->add('name', TextType::class, array(
              'label' => 'Nom',
              'attr' => array('placeholder' => 'Nom'),
            ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'USTA\MemberBundle\Entity\Phone'
        ));
    }

}
