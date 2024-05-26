<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;


class BookController extends Controller
{
    public function index(){
        $books = Book::all();
        return view('pages.index', ['books' =>$books]);
    }

    public function create(){
        return view('pages.addbook');
    }

    public function store(Request $request){
        $data = $request->validate([
            'title'=>'required',
            'author'=>'required'
        ]);

        $newBook = Book::create($data);
        return redirect(route('book.index'));

    }

    public function edit(Book $book){
        return view('pages.editbook', ['book' => $book]);
    }

    public function update(Book $book, Request $request){
        $data = $request->validate([
            'title'=>'required',
            'author'=>'required'
        ]);

        $book->update($data);
        return redirect(route('book.index'))->with('success', 'Book Updated Successfully');
    }

    public function delete(Book $book){
        $book->delete();
        return redirect(route('book.index'))->with('success', 'Book deleted Successfully');

    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $books = Book::where('title', 'LIKE', "%{$query}%")
                     ->orWhere('author', 'LIKE', "%{$query}%")
                     ->get();

        return view('pages.index', ['books' => $books]);
    }
}

