<?php
/**
 * Created by PhpStorm.
 * User: Just1ce
 * Date: 07.03.17
 * Time: 14:18
 */

namespace App;

use Illuminate\Database\Eloquent\Model;


class Book extends Model {
    protected $table = 'books';
    public $timestamps = false;

    protected $casts = [
        'id'   => 'integer',
        'year' => 'integer',
    ];

    private static $sortParams = [
        'name', 'author'
    ];

    public static $rulesForCreate = [
        'name'        => 'required|max:150|string',
        'author'      => 'required|max:100|string',
        'year'        => 'integer',
        'description' => 'required|max:2000|string',
        'image'       => 'required|image|max:500'
    ];

    public static $rulesForEdit = [
        'name'        => 'max:150|string',
        'author'      => 'max:100|string',
        'year'        => 'integer',
        'description' => 'max:2000|string',
        'image'       => 'image|max:500'
    ];

    public static function addSort($query, $array) {
        foreach (self::$sortParams as $value) {
            if(isset($array[$value])) {
                $query->orderBy($value, $array[$value]);
            }
        }
    }

    public static function createFromRequest($request) {
        $newBook = new static;
        $newBook->name = $request['name'];
        $newBook->author = $request['author'];
        $newBook->description = $request['description'];
        $newBook->image = $request['fileName'];
        if(isset($request['year'])) {
            $newBook->year = $request['year'];
        }

        $newBook->save();
        return $newBook;
    }

    public function updateFromRequest($request) {
        if(isset($request['name'])) {
            $this->name = $request['name'];
        }

        if(isset($request['author'])) {
            $this->author = $request['author'];
        }

        if(isset($request['description'])) {
            $this->description = $request['description'];
        }

        if(isset($request['year'])) {
            $this->year = $request['year'];
        }

        if(isset($request['fileName'])) {
            $this->image = $request['fileName'];
        }

        $this->save();
    }


}