@extends('layouts.app') @section('content')

<div class="container-lg">
    <div class="row justify-content-center mb-3">
        <div class="col-lg-4">
            <b> Авторы: </b>
        </div>
        <div class="col-lg-4">
            <b> Кол-во книг: </b>
        </div>
    </div>
    @foreach($authors as $author)
    <div class="row justify-content-center">
        <div class="col-lg-4">
            <p> {{ $author->name }} </p>
        </div>
        <div class="col-lg-4">
            <p> {{ $author->books()->count() }} </p>
        </div>
        <hr />
    </div>
    @endforeach
</div>
</div>

@endsection