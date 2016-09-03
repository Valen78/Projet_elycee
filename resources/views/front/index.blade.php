@extends('layout.master')

@section('title', $title)

@section('content')
    <div class="text-center well">
        <h1>Bienvenue sur le site du Lycée</h1>
    </div>

    <div class="row">
        @forelse($posts as $i => $post)
            <div class="col-md-6">
                @include('front.partials.posts')
            </div>
            @if($i%2 != 0)
                <div class="clearfix"></div>
            @endif
        @empty
            <p class="lead">Aucun Article publié !</p>
        @endforelse
    </div>
@endsection