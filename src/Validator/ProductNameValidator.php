<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use App\Validator\ProductName;

class ProductNameValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint){

        $this->context->buildViolation($constraint->message)
        ->setParameter('{{ string }}', $value)
        ->addViolation();
        if (!$constraint instanceof ProductName){
            throw new UnexpectedTypeException($constraint, ProductName::class);
        }

        die('je suis dans le validateur');
        if (!preg_match('/^[p-P]/', $value, $matches)){
            $this->context->buildViolation($constraint->message)
            ->setParameter('{{ string }}', $value)
            ->addViolation();
        }

    }
}

