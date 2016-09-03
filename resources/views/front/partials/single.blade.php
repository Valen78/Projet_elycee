@if(Session::has('message'))
    <div class="alert alert-success text-center"><h1>{{Session::get('message')}}</h1></div>
@endif

<article>
<div class="well">
    @include('front.partials.picture')

    <h3 class="text-uppercase">{{$post->title}}</h3>

    <div class="text-justify">
        <p>{!!nl2br($post->content)!!}</p>
    </div>

    @include('front.partials.metas')
</div>

    <hr class="hr">


            <h3 class="text-center">Commentaires :</h3>
            @forelse($comments as $comment)
            <div class="well comments">
                <h4 class="lead">{{$comment->title}}</h4>
                <p class="text-justify">{!! nl2br($comment->content) !!}</p>
                <small>le {{$comment->date->format('d/m/Y H:i:s')}}</small>
            </div>
            @empty
                <p class="text-center text-info"><em>Pas encore de commentaires</em></p>
        @endforelse

    <hr class="hr">

    <p class="lead">Laisser un commentaire ?</p>
    <div class="col-sm-4">
        <form action="{{url('comment')}}" method="post" class="coms" id="coms">
            {{csrf_field()}}
            {!! Honeypot::generate('my_name', 'my_time') !!}

            <input type="hidden" name="post_id" value="{{$post->id}}">
            <input type="hidden" name="date" value="{{$date}}">

            <div class="form-group">
                <label for="title" class="control-label">Titre <span class="red">*</span></label>
                <input type="text" name="title" id="title" class="form-control" value="{{old('title')}}" placeholder="Titre*">
                @if($errors->has('title'))<span class="label label-danger">{{$errors->first('title')}}</span>@endif
            </div>

            <div class="form-group">
                <label for="content" class="control-label">Commentaire <span class="red">*</span></label>
                <textarea name="content" id="content" class="form-control" cols="30" rows="5" placeholder="Votre commentaire*">{{old('content')}}</textarea>
                @if($errors->has('content'))<span class="label label-danger">{{$errors->first('content')}}</span>@endif
            </div>

            <button type="submit" name="submit" id="submit" class="btn btn-orange">Envoyer &nbsp;<i class="fa fa-commenting-o" aria-hidden="true"></i></button>
        </form>
        <p class="small red">* les champs avec un astérisque sont obligatoires.</p>
    </div>
</article>