<?php
/**
 * Created by PhpStorm.
 * User: Just1ce
 * Date: 07.03.17
 * Time: 17:11
 */

namespace App\Exceptions;


class ApiValidationException extends ApiException {

    protected $errors;

    public function __construct($typeName, $methodName, $errors)
    {
        parent::__construct("Validation error!", $typeName, $methodName, 400);
        $this->errors = $errors;
    }

    public function toArray() {
        $array = parent::toArray();
        $array['errors'] = $this->errors;
        return $array;
    }

}