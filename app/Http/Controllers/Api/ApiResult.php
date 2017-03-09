<?php
/**
 * Created by PhpStorm.
 * User: Just1ce
 * Date: 07.03.17
 * Time: 15:33
 */

namespace App\Http\Controllers\Api;


use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

class ApiResult implements Arrayable, Jsonable {
    private $data;

    public function __construct() {
        $this->data = collect(['success' => true]);
    }

    public function add($key, $value) {
        $this->data->put($key, $value);
    }

    public function addArray($array) {
        foreach ($array as $key => $value) {
            $this->add($key, $value);
        }
    }

    public function toArray() {
        return $this->data->toArray();
    }

    public function toJson($options = 0) {
        return $this->data->toJson($options);
    }

}