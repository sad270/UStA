<?php

// src/USTA/MemberBundle/Validator/Constraints/Gender.php
namespace USTA\MemberBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Gender extends Constraint
{
    public $message = 'L\'option %string% n\'est pas autorisé.';
}

?>
