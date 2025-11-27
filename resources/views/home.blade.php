@extends('layouts.app')

@section('content')

@auth
<x-post-form />
@endauth

@foreach($posts as $post)
<x-post-card :post="$post" />
@endforeach

@endsection