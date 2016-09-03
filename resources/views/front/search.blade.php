@extends('layout.master')

@section('title', $title)

@section('content')
    <div class="text-center well">
        <h1>Résultat de votre recherche</h1>
    </div>

    <div class="text-center">{{$posts->appends(['t'=>$search])->render()}}</div>

    @forelse($posts as $post)
        @include('front.partials.actus')
    @empty
        <p class="lead">Aucun article trouvé !</p>
    @endforelse

    <div class="text-center">{{$posts->appends(['t'=>$search])->render()}}</div>

@endsection