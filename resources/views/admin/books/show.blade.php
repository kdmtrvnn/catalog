@extends('layouts.app') @section('content')

<div class="container">
    <div class="row align-items-center mb-3">
    <div class="col">
      <b> Название: </b> 
    </div>
    <div class="col">
      <b> Год: </b> 
    </div>
    <div class="col">
      <b> Авторы: </b> 
    </div>
  </div>
    @foreach($books as $book)
    <div class="row align-items-center">
    <div class="col">
      <div class="d-flex">
      <a href="edit/{{ $book->id }}"> {{ $book->name }} </a>
       <form method="post" action="delete/{{ $book->id }}">
    @csrf
  <button type="submit" class="btn btn-secondary ms-4">Удалить</button>
  </form>
    </div>
    </div>
    <div class="col">
      <p> {{ $book->year }} </p>
    </div>
    <div class="col">
      @foreach($book->authors as $author)
      <p> {{ $author->name }} </p>
      @endforeach
    </div>
     <hr />
  </div>
    @endforeach
</div>

@endsection