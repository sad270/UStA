<?php
namespace USTA\MemberBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
//Type
use \Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RelationshipTypeType extends AbstractType
{
    public function getChoices()
    {
        return array(
          'Père'               => 'FATH' ,
          'Mère'               => 'MOTH' ,
          'Fils'               => 'SON'  ,
          'Fille'              => 'DAUGH',
          'Grand-père'         => 'GRFAT',
          'Grand-mère'         => 'GRMOT',
          'Arrière-grand-père' => 'GRGRF',
          'Arrière-grand-mère' => 'GRGRM',
          'Neveu'              => 'NEPHE',
          'Nièce'              => 'NIECE',
          'Oncle'              => 'UNCLE',
          'Tante'              => 'AUNT' ,
          'Autre (Homme)'      => 'OTHRM',
          'Autre (Femme)'      => 'OTHRF',
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'choices' => $this->getChoices(),
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
