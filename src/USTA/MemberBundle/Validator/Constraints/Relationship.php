<?php

// src/USTA/MemberBundle/Validator/Constraints/Relationship.php
namespace USTA\MemberBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Relationship extends Constraint
{
    public $message = 'L\'option %string% n\'est pas autorisé.';
}

?>
