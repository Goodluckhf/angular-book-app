<?php
/**
 * Created by PhpStorm.
 * User: Just1ce
 * Date: 07.03.17
 * Time: 16:57
 */

namespace App\Exceptions;


use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

class ApiException extends \Exception implements Jsonable, Arrayable {
    protected $status;
    protected $typeName;
    protected $methodName;

    public function __construct($message = "", $typeName, $methodName, $status) {
        parent::__construct($message, 0, null);
        $this->methodName = $methodName;
        $this->typeName = $typeName;
        $this->status = $status;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getTypeName() {
        return $this->typeName;
    }

    public function getMethodName() {
        return $this->methodName;
    }

    public function toJson($options = 0)
    {
        return json_encode($this->toArray(), $options);
    }

    public function toArray()
    {
        return [
            'success' => false,
            'type'    => $this->typeName,
            'method'  => $this->methodName,
            'message' => $this->message
        ];
    }

}