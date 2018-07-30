<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BooksController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * GET /books
     * @return array
     */
    public function index()
    {
        return Book::all();
    }

    /**
     * GET /books/{id}
     * @param integer $id
     * @return mixed
     */
    public function show($id)
    {
        try {
            return Book::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => [
                    'message' => 'Book not found'
                ]
            ], 404);
        }
    }

    /**
     * POST /books
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function store(Request $request)
    {
        $book = Book::create($request->all());
        
        return response()->json(['created' => true], 201, [
            'Location' => route('books.show', ['id' => $book->id])
        ]);
    }

    /**
     * PUT /books/{id}
     * 
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        try {
            $book = Book::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => [
                    'message' => 'Book not found'
                ]
            ], 404);
        }

        $book->fill($request->all());
        $book->save();

        return $book;
    }
}
