@extends('layouts.app') @section('content')

<div class="mb-3" id="update"></div>

<script>var authors = @json($authors)</script>
<script>var book = @json($book)</script>
<script>var authorsBook = @json($book->authors)</script>
<script>var id = @json($id)</script>

@endsection