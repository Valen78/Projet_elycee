@extends('layout.master')

@section('title', $title)

@section('content')
    @if(!is_null($post))
        @include('front.partials.single')
    @else
        <p class="lead">Article inexistant !</p>
    @endif
@endsection