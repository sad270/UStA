<?php

// src/USTA/MemberBundle/Validator/Constraints/PhoneTypeValidator.php
namespace USTA\MemberBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use USTA\MemberBundle\Form\Type\PhoneTypeType;

/**
 * @Annotation
 */
class PhoneTypeValidator extends ConstraintValidator
{
  private $type;

  public function __construct()
  {
    $this->type = new PhoneTypeType;
  }

  public function validate($value, Constraint $constraint)
  {
      if (!(in_array($value, $this->type->getChoices(), true))) {
          $this->context->addViolation($constraint->message, array('%string%' => $value));
      }
  }
}

?>
