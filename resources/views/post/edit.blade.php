@extends('layouts.app')

@section('content')
<h2>Edit Post</h2>
<x-post-form :post="$post" placeholder="Edit your thought..." />
@endsection