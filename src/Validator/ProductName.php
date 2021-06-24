<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ProductName extends Constraint{

    public $message = 'the string "{{ string }}" must begin with caractere p';
}