<?php

namespace USTA\AccountBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

//Type
use \Symfony\Component\Form\Extension\Core\Type\CollectionType;
use \Symfony\Component\Form\Extension\Core\Type\TextareaType;
use \Symfony\Component\Form\Extension\Core\Type\SubmitType;
use \Symfony\Component\Form\Extension\Core\Type\TextType;
use \Symfony\Component\Form\Extension\Core\Type\DateType;
use \Symfony\Component\Form\Extension\Core\Type\NumberType;
use \Symfony\Bridge\Doctrine\Form\Type\EntityType;

class MembershipFeeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      // On ajoute une fonction qui va écouter un évènement
      $builder->addEventListener( FormEvents::PRE_SET_DATA, function(FormEvent $event) {

        $membershipFee = $event->getData();
        // Cette condition est importante
        if (null === $membershipFee) {
          return; // On sort de la fonction sans rien faire lorsque $advert vaut null
        }

        if (null !== $membershipFee->getFamily()) {
          $event->getForm()
          ->add('members', EntityType::class, array(
            'class'    => 'USTAMemberBundle:Member',
            'choice_label' => function($member){ return $member->getId() . ' ' . $member->getLastname() . ' ' . $member->getfirstname();},
            'multiple' => true,
            'expanded' => true,
            'label' => 'Membres',
            'query_builder' => function(\USTA\MemberBundle\Repository\MemberRepository $repo) use ($membershipFee)
              {return $repo->findByFamilyBuilder($membershipFee->getFamily());}
            ));
          }
        }
      );

      $builder
        // ->add('members', EntityType::class, array(
        //     'class'    => 'USTAMemberBundle:Member',
        //     'choice_label' => 'lastname',
        //     'multiple' => true,
        //     'expanded' => true,
        //     'label' => 'Membres',
        //     'query_builder' => function(\USTA\MemberBundle\Repository\MemberRepository $repo) {
        //                           return $repo->findByFamilyBuilder(45);
        //                         }
        //   ))
          ->add('lastname', TextType::class, array(
            'attr' => array('placeholder' => 'Nom'),
            'label' => 'Nom'
          ))
          ->add('firstname', TextType::class, array(
            'attr' => array('placeholder' => 'Prénom'),
            'label' => 'Prénom'
          ))
          ->add('date', DateType::class, array(
            'attr' => array('placeholder' => '31 12 1975'),
            'label' => 'Date du paiement',
            'widget' => 'single_text',
            'format' => 'dd MM yyyy'
          ))
        ->add('year', NumberType::class, array(
          'attr' => array('placeholder' => 'Année'),
          'label' => 'Année'
        ))
        ->add('reference', TextType::class, array(
          'attr' => array('placeholder' => 'Ref'),
          'label' => 'Ref'
        ))
        ->add('note', TextareaType::class, array(
          'label' => 'Commentaire',
          'attr' => array( 'placeholder' => "Une petite note")
        ))
        ->add('Valider', SubmitType::class)
      ;




    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'USTA\AccountBundle\Entity\MembershipFee',
        'cascade_validation' => true
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'usta_accountbundle_membershipfee';
    }
}
