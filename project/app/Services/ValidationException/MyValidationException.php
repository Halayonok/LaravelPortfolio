<?php

namespace App\Services\ValidationException;

use Exception;
use Illuminate\Validation\ValidationException;

class MyValidationException extends ValidationException
{

    /**
     * MyValidationException constructor.
     * @param $validator
     * @param null $response
     * @param string $errorBag
     */
    public function __construct($validator, $response = null, $errorBag = 'default')
    {
        Exception::__construct('Не все поля заполнены верно');

        $this->response = $response;
        $this->errorBag = $errorBag;
        $this->validator = $validator;
    }
}
