<?php

namespace App\Exceptions;

use Illuminate\Validation\ValidationException;

class ConfirmRequestValidationException extends ValidationException
{
    public function errors()
    {
        $errors = parent::errors();
        
        unset($errors['_confirm']);
        
        return $errors;
    }
}
