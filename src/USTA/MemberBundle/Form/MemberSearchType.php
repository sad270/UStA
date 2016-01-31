<?php
namespace USTA\MemberBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
//Type
use Symfony\Component\Form\Extension\Core\Type\SearchType;

class MemberSearchType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       $builder
       ->add('firstname_lastname', SearchType::class, array(
         'attr' => array(
           'placeholder' => 'Rechercher ...',
           'autocomplete' => 'off',
           'spellcheck' => 'false',
           'class' => 'form-control typeahead-member-search'
         ),
         'label' => false
       ))
       ;
   }

   /**
    * @param OptionsResolverInterface $resolver
    */
   public function configureOptions(OptionsResolver $resolver)
   {
       $resolver->setDefaults(array(
           'data_class' => 'USTA\MemberBundle\Entity\MemberSearch'
       ));
   }
}
