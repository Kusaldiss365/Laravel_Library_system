<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        try {
            $books = Book::all();

            if ($books->isEmpty()) {
                return response()->json(['error' => "No Books Found !"], 404);
            }

            return response()->json(['books' => $books], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request){
        $data = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'pub_year' => 'required|numeric',
            'description' => 'nullable'
        ]);
        try{
            $newBook = Book::create($data);

            return response()->json(['book'=>$newBook],200);
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        } 
    }

    public function bookById($id){
        try{
            $book = Book::findOrFail($id);

            return response()->json($book, 200);
        }catch(\Exception $e){
            return response()->json(['error'=>$e->getMessage()], 400);
        }
    }

    //Requests data from user
    public function edit(Book $book, Request $request, $id){

        try{
            $book = Book::findOrFail($id);

            $data = $request->validate([
                'title' => 'required',
                'author' => 'required',
                'pub_year' => 'required|numeric',
                'description' => 'nullable'
            ]);

            $book->update($data);

            return response()->json(['message' => 'Book updated successfully'], 200);

         }catch(\Exception $e){

        return response()->json(['error'=>$e->getMessage()], 400);

        }
    }

    public function deleteBook(Book $book, $id){

        try{$book = Book::findOrFail($id);

        $book -> delete();

        return response()->json(['messagge' => "Successfully Deleted !"], 200);
    
    }catch(\Exception $e){

        return response()->json(['error'=>$e->getMessage()], 400);

    }
    }

    
}
