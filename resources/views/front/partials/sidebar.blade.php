<div class="col-md-4 col-lg-3 col-lg-offset-1 hidden-xs hidden-sm">
<aside>
    <h4>A lire aussi</h4>
    <hr>
    <ul>
        @forelse($others as $other)
            <li><a href="{{url('article',$other->id)}}">-> {{$other->title}}</a></li>
        @empty
            <li>Aucun article publié</li>
        @endforelse
    </ul>
    <br>
    <img src="{{url('imgs','tweet-flux.png')}}" alt="flux tweeter" class="img-responsive center-block">
</aside>
</div>