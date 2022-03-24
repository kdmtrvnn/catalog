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
    <div class="row align-items-center ">
    <div class="col">
      <p> {{$book->name}} </p>
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