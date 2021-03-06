<?php

namespace USTA\MemberBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
//Type
use \USTA\MemberBundle\Form\Type\EmailTypeType;
use \Symfony\Component\Form\Extension\Core\Type\EmailType;
use \Symfony\Component\Form\Extension\Core\Type\TextType;

class MailType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', EmailTypeType::class, array(
              'label' => "Type"
            ))
            ->add('email', EmailType::class, array(
              'attr' => array('placeholder' => 'adressemail@monmail.com'),
              'label' => "Email"
            ))
            ->add('name', TextType::class, array(
              'attr' => array('placeholder' => 'Nom'),
              'label' => "Nom"
            ))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'USTA\MemberBundle\Entity\Email'
        ));
    }

}
