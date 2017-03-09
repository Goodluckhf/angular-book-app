<?php
/**
 * Created by PhpStorm.
 * User: Just1ce
 * Date: 08.03.17
 * Time: 12:42
 */

namespace App\Exceptions;


class ApiNotFoundException extends ApiException {

    public function __construct($typeName, $methodName)
    {
        parent::__construct("Nothing found!", $typeName, $methodName, 404);
    }

}