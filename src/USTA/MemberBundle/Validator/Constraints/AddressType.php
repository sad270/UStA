<?php

// src/USTA/MemberBundle/Validator/Constraints/AddressType.php
namespace USTA\MemberBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class AddressType extends Constraint
{
    public $message = 'L\'option %string% n\'est pas autorisé.';
}

?>
