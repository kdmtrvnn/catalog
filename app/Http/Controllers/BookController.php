<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function show()
    {
        $books = Book::get();

        return view('books.show', ['books' => $books]);
    }
}
