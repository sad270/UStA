<?php
namespace USTA\UserBundle\Validator;

use Symfony\Component\Validator\Constraint;

/** @Annotation */
class CheckEmailAndCode extends Constraint
{
    public function validatedBy()
    {
        return 'check_email_and_code';
    }

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
