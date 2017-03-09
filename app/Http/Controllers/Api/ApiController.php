<?php
/**
 * Created by PhpStorm.
 * User: Just1ce
 * Date: 07.03.17
 * Time: 15:29
 */

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller as BaseController;
use \App\Exceptions\ApiValidationException;
use Validator;
use Request;



class ApiController extends BaseController {
    protected $typeName   = '';
    protected $methodName = '';

    protected function respond(ApiResult $result) {
        return response($result->toJson(), 200)
            ->header('Content-Type', 'application/json');
    }

    protected function respondEmpty() {
        $apiResult = new ApiResult;
        return $this->respond($apiResult);
    }

    protected function validate($rules) {
        $validator = Validator::make(Request::all(), $rules);

        if($validator->fails()) {
            $mes = $validator->messages();
            throw new ApiValidationException($this->typeName, $this->methodName, $mes->all());
        }
    }

    protected function getArrayFromRequest($array) {
        $params = [];
        foreach ($array as $value) {
            if(Request::has($value)) {
                $params[$value] = Request::get($value);
            }
        }

        return $params;
    }

}