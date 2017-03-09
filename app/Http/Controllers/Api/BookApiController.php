<?php
/**
 * Created by PhpStorm.
 * User: Just1ce
 * Date: 07.03.17
 * Time: 16:00
 */

namespace App\Http\Controllers\Api;
use App\Exceptions\ApiNotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Request;
use \App\Book;
use Storage;


class BookApiController extends ApiController {
    protected $typeName = 'Book';

    const PER_PAGE     = 2;
    const MAX_PER_PAGE = 10;

    private function getPerPage() {
        return Request::has('count') && Request::get('count') < self::MAX_PER_PAGE ? Request::get('count') : self::PER_PAGE;
    }

    public function getList() {
        $this->methodName = 'getList';
        $apiResult = new ApiResult;
        $query = Book::query();
        if(Request::has('q')) {
            $query->where('name', 'like', '%' . Request::get('q') . '%')
                ->orWhere('author', 'like', '%' . Request::get('q') . '%');
        }

        if(Request::has('sort')) {
            $sort = Request::get('sort');
            Book::addSort($query, $sort);
        }
        $perPage = $this->getPerPage();
        $booksPaginator = $query->paginate($perPage);
        if($booksPaginator->total() === 0) {
            throw new ApiNotFoundException($this->typeName, $this->methodName);
        }

        $extraParams = $this->getArrayFromRequest([
            'count', 'q', 'sort'
        ]);

        $booksPaginator->appends($extraParams);
        $apiResult->addArray($booksPaginator->toArray());


        return $this->respond($apiResult);
    }

    public function getById() {
        $this->methodName = 'getById';
        $this->validate([
            'id' => 'required|integer'
        ]);
        $apiResult = new ApiResult;
        try {
            $book = Book::findOrFail(Request::get('id'));
        } catch (ModelNotFoundException $e) {
            throw new ApiNotFoundException($this->typeName, $this->methodName);
        }

        $apiResult->add('data', $book);

        return $this->respond($apiResult);
    }

    public function add() {
        $this->methodName = 'add';
        $this->validate(Book::$rulesForCreate);

        $file = Request::file('image');
        $fileName =  $file->store('images', 'public');
        $request = Request::all();
        $request['fileName'] = $fileName;
        $newBook = Book::createFromRequest($request);
        $apiResult = new ApiResult;
        $apiResult->add('id', $newBook->id);
        return $this->respond($apiResult);
    }

    public function remove() {
        $this->methodName = 'remove';
        $this->validate([
            'id' => 'required|integer'
        ]);

        $bookForDeleting = Book::find(Request::get('id'));
        if($bookForDeleting) {
            Storage::disk('public')->delete($bookForDeleting->image);
            $bookForDeleting->delete();
        }

        return $this->respondEmpty();
    }

    public function edit() {
        $this->methodName = 'edit';
        $validationRules = Book::$rulesForEdit;
        $validationRules['id'] = 'required|integer';
        $this->validate($validationRules);
        $request = Request::all();
        try {
            $bookForEditing = Book::findOrFail(Request::get('id'));
        } catch (ModelNotFoundException $e) {
            throw new ApiNotFoundException($this->typeName, $this->methodName);
        }

        if(Request::hasFile('image')) {
            $fileName = Request::file('image')->store('images', 'public');
            $request['fileName'] = $fileName;
            Storage::disk('public')->delete($bookForEditing->image);
        }

        $bookForEditing->updateFromRequest($request);
        $apiResult = new ApiResult;
        $apiResult->add('data', $bookForEditing);
        return $this->respond($apiResult);
    }
}