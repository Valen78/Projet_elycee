@extends('layout.master')

@section('title', $title)

@section('content')
    <div class="text-center">{{$posts->links()}}</div>

    @forelse($posts as $post)
        @include('front.partials.actus')
    @empty
        <p class="lead">Aucun Article publié !</p>
    @endforelse

    <div class="text-center">{{$posts->links()}}</div>
@endsection