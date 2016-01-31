<?php

namespace USTA\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
//Type
use \Symfony\Component\Form\Extension\Core\Type\EmailType;
use \Symfony\Component\Form\Extension\Core\Type\TextType;
use \Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SendInvitationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      $builder
        ->add('email', EmailType::class, array(
          'label' => 'Email',
          'attr' => array( 'placeholder' => "email@exemple.com")
        ))
        ->add('lastname', TextType::class, array(
          'label' => 'Nom',
          'attr' => array( 'placeholder' => "NOM")
        ))
        ->add('firstname', TextType::class, array(
          'label' => 'Prénom',
          'attr' => array( 'placeholder' => "Prénom")
        ))
        ->add('Inviter', SubmitType::class)
      ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'USTA\UserBundle\Entity\Invitation',
        ));
    }

}
