<?php

// src/USTA/MemberBundle/Validator/Constraints/EmailTypeValidator.php
namespace USTA\MemberBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use USTA\MemberBundle\Form\Type\EmailTypeType;

/**
 * @Annotation
 */
class EmailTypeValidator extends ConstraintValidator
{
  private $type;

  public function __construct()
  {
    $this->type = new EmailTypeType;
  }

  public function validate($value, Constraint $constraint)
  {
      if (!(in_array($value, $this->type->getChoices(), true))) {
          $this->context->addViolation($constraint->message, array('%string%' => $value));
      }
  }
}

?>
