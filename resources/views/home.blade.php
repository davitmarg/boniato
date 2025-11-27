@extends('layouts.app')

@section('content')

@auth
<x-post-form />
@endauth

<div id="feed-container">
    @include('partials.feed')
</div>

@endsection