<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;


class AddCaractere extends Constraint{

    public $message = 'the string "{{ string }}" must begin with caractere p';
}