<article class="jumbotron">

    @include('front.partials.picture')

    <h3 class="text-uppercase"><a href="{{url('article',$post->id)}}">{{$post->title}}</a></h3>

    <div class="text-justify">
        @if(empty($post->abstract))
            <p><small>{!! nl2br(excerpt($post->content,30)) !!}</small></p>
        @else
            <p><small>{!! nl2br($post->abstract) !!}...</small></p>
        @endif
    </div>

    <p class="text-right"><a href="{{url('article',$post->id)}}" class="small"><strong>Lire la suite</strong></a></p>

    @include('front.partials.metas')
</article>