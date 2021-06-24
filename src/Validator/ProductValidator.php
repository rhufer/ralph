<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;


class ProductValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint){
        if (!$constraint instanceof AddCaractere){
            throw new UnexpectedTypeException($constraint, AddCaractere::class);
        }

        die('je suis dans le validateur');
        if (!preg_match('/^[p-P]/', $value, $matches)){
            $this->context->buildViolation($constraint->message)
            ->setParameter('{{ string }}', $value)
            ->addViolation();
        }

    }
}

