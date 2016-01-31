<?php

namespace USTA\MemberBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
//Type
use \USTA\MemberBundle\Form\Type\RelationshipTypeType;
// use \USTA\MemberBundle\Form\Type\GenderTypeType;
use \Symfony\Component\Form\Extension\Core\Type\TextType;
use \Symfony\Component\Form\Extension\Core\Type\DateType;

class MemberType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('relationship', RelationshipTypeType::class, array(
              'label' => 'Lien'
            ))
            ->add('lastname', TextType::class, array(
              'attr' => array('placeholder' => 'Nom'),
              'label' => 'Nom'
            ))
            ->add('firstname', TextType::class, array(
              'attr' => array('placeholder' => 'Prénom'),
              'label' => 'Prénom'
            ))
            // ->add('gender', GenderType::class, array(
            //   'label' => 'Genre'
            // ))
            ->add('birthDate', DateType::class, array(
              'attr' => array('placeholder' => '31 12 1975'),
              'label' => 'Date de Naissance',
              'widget' => 'single_text',
              'format' => 'dd MM yyyy'
            ))
            ->add('birthPlace', TextType::class, array(
              'attr' => array('placeholder' => 'Lieu de Naissance'),
              'label' => 'Lieu de Naissance',
            ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'USTA\MemberBundle\Entity\Member'
        ));
    }
}
