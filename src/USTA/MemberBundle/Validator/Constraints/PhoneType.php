<?php

// src/USTA/MemberBundle/Validator/Constraints/PhoneType.php
namespace USTA\MemberBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class PhoneType extends Constraint
{
    public $message = 'L\'option %string% n\'est pas autorisé.';
}

?>
