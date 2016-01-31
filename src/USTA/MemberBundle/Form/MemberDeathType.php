<?php

namespace USTA\MemberBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
//Type
use \Symfony\Component\Form\Extension\Core\Type\SubmitType;
use \Symfony\Component\Form\Extension\Core\Type\TextType;
use \Symfony\Component\Form\Extension\Core\Type\DateType;

class MemberDeathType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->remove('relationship')
            ->add('deathDate', DateType::class, array(
              'label' => 'Date de Décès',
              'widget' => 'single_text',
              'format' => 'dd MM yyyy',
              'attr' => array(
                          'readonly' => false,
                          'placeholder' => '31 12 1975'
                        ),
            ))
            ->add('deathPlace', TextType::class, array(
              'label' => 'Lieu de Décès',
              'attr' => array(
                          'readonly' => false,
                          'placeholder' => 'Lieu de Décès'
                        ),
            ))
            ->add('Déclarer', SubmitType::class)
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'USTA\MemberBundle\Entity\Member',
            'attr' => array('readonly' => true)
            // 'read_only' => true
        ));
    }

    public function getParent()
    {
        return MemberType::class;
    }
}
