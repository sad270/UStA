<?php

namespace USTA\MemberBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
//Type
use \Symfony\Component\Form\Extension\Core\Type\CollectionType;
use \Symfony\Component\Form\Extension\Core\Type\TextareaType;
use \Symfony\Component\Form\Extension\Core\Type\SubmitType;

class FamilyType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      $builder
        ->add('members', CollectionType::class, array(
            'entry_type' => MemberType::class,
            'label' => false,
            'error_bubbling' => false,
            'mapped' => true,
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => false
          ))
        ->add('addresses', CollectionType::class, array(
            'entry_type' => AddressType::class,
            'label' => false,
            'error_bubbling' => false,
            'mapped' => true,
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => false
          ))
        ->add('phones', CollectionType::class, array(
            'entry_type' => PhoneType::class,
            'label' => false,
            'error_bubbling' => false,
            'mapped' => true,
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => false
          ))
        ->add('emails', CollectionType::class, array(
            'entry_type' => MailType::class,
            'label' => false,
            'error_bubbling' => false,
            'mapped' => true,
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => false
          ))
        ->add('note', TextareaType::class, array(
          'label' => false,
          'attr' => array( 'placeholder' => "Une petite note")
        ))
        ->add('Sauvegarder', SubmitType::class)
      ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'USTA\MemberBundle\Entity\Family',
        'cascade_validation' => true
        ));
    }
}
