<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateRequest;
use App\Http\Requests\Admin\UpdateRequest;
use App\Models\Book;
use App\Models\Author;
use App\Models\AuthorBook;

class CatalogController extends Controller
{
    public function add()
    {
        $authors = Author::get();

        return view('admin.books.create', ['authors' => $authors]);
    }

    public function create(CreateRequest $request)
    {
        $book = Book::create([
            'name' => $request[0]['name'],
            'year' => $request[0]['year'],
        ]);

        foreach($request[0]['authors'] as $name) {
            $author = Author::where('name', $name)->first();

            AuthorBook::create([
                'author_id' => $author->id,
                'book_id' => $book->id,
            ]);
        }

        return redirect('/');
    }

    public function getBooks()
    {
        $books = Book::get();

        return view('admin.books.show', ['books' => $books]);
    }

    public function getAuthors()
    {
        $authors = Author::get();

        return view('admin.authors.show', ['authors' => $authors]);
    }

    public function edit($id)
    {
        $book = Book::where('id', $id)->first();
        $authors = Author::get();

        return view('admin.books.update', ['id' => $id, 'book' => $book, 'authors' => $authors]);
    }

    public function update(UpdateRequest $request)
    {
        Book::where('id', $request[0]['id'])->update([
            'name' => $request[0]['name'],
            'year' => $request[0]['year'],
        ]);

        $newAutors = [];
        $book = Book::where('id', $request[0]['id'])->first();
        $oldAuthors = $book->authors()->get();

        foreach($request[0]['authors'] as $name) {
            $author = Author::where('name', $name)->first();
           
            $authorBook = AuthorBook::where([['author_id', $author->id], ['book_id', $book->id]])->first();

            if($authorBook) {
                array_push($newAutors, $authorBook);
            } elseif(!$authorBook) {
                AuthorBook::create([
                    'author_id' => $author->id,
                    'book_id' => $book->id,
                ]);
            } 
        }

        if($newAutors) {

        $idsOld = [];
        $idsNew = [];

        foreach($oldAuthors as $oldAuthor) {
            array_push($idsOld, $oldAuthor->id);
        }

        foreach($newAutors as $newAuthor) {
            array_push($idsNew, $newAuthor->author_id);
        }

        $diff = array_diff($idsOld, $idsNew);

        foreach($diff as $item) {
            AuthorBook::where([['author_id', $item], ['book_id', $book->id]])->delete();
        }
    }
        return redirect('/');
    }

    public function show()
    {
        $books = Book::get();

        return view('admin.book.update');
    }

    public function delete($id)
    {
        Book::find($id)->delete();

        return redirect()->back();
    }
}
