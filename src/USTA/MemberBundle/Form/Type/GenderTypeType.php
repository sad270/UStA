<?php
namespace USTA\MemberBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
//Type
use \Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class GenderTypeType extends AbstractType
{
    public function getChoices()
    {
        return array(
          'Homme' => 'M',
          'Femme' => 'F',
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'choices' => $this->getChoices(),
            'expanded' => true,
            'multiple' => false,
        ));
    }

    public function getParent()
    {
        return ChoiceType::class;
    }
}
?>
