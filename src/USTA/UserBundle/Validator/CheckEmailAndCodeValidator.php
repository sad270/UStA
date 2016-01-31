<?php
namespace USTA\UserBundle\Validator;

use Symfony\Component\Validator\ConstraintValidator;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Constraint;

class CheckEmailAndCodeValidator extends ConstraintValidator
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function validate($object, Constraint $constraint)
    {
        $result = $this->em
            ->getRepository('USTAUserBundle:Invitation')
            ->CheckEmailAndCode($object->getEmail(), $object->getInvitation())
        ;

        if (count($result) == 0) {
            $this->context->addViolation('Une erreur s\'est produite lors de la validation du code et de l\'email. Veuillez saisir le bon code et l\'adresse email qui a recut ce code');
        }
    }

}
