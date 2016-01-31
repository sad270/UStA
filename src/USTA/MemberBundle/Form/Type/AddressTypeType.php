<?php
namespace USTA\MemberBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
//Type
use \Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AddressTypeType extends AbstractType
{
    public function getChoices()
    {
        return array(
          'Principale'          => 'M',
          'Secondaire'          => 'S',
          'Étrangère'           => 'F',
          'En cas d\'urgence'   => 'E',
          'Autre'               => 'O',
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'choices' => $this->getChoices(),
            'data' => 'M',
            'expanded' => false,
            'multiple' => false,
            'placeholder' => 'Choisissez une option',
        ));
    }

    public function getParent()
    {
        return ChoiceType::class;
    }
}
?>
