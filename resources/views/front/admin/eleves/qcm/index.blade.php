@extends('layout.admin')

@section('title', $title)

@section('content')
    @if(Session::has('message'))
        <div class="alert alert-success text-center"><h1>{{Session::get('message')}}</h1></div>
    @endif

    <div class="col-lg-10">
    <h2>{{$fiche->title}}</h2>

    <form name="question" id="question" action="{{url('admin/score', $fiche->id)}}" method="post" class="form-horizontal col-sm-10 col-sm-offset-1">
        {{csrf_field()}}
        <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}">
        <div class="form-group well">
            <label class="col-sm-3 control-label"><h3>Question : </h3></label>
            <div class="col-sm-8">
                <h3 class="form-control-static">{!! $fiche->content !!}</h3>
            </div>
        </div>
        @forelse($fiche->choices as $choice)
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-8">
                            <div class="checkbox lead">
                                <label>
                                    <input type="checkbox" name="status{{$choice->id}}" id="status" value="ok"
                                    @foreach($answers as $answer)
                                        @if($answer->choice_id == $choice->id)
                                            {{($answer->choice_user == 'ok')?'checked':''}} disabled
                                                @endif
                                            @endforeach
                                    >
                                    @if($score->status_question == 'fait')
                                        <span class="{{($choice->status == 'yes')?'green':'red'}}">{!! $choice->content !!}</span>
                                    @else
                                        {!! $choice->content !!}
                                    @endif
                                </label>
                            </div>
                        </div>
                    </div>
            @if($errors->has('status'.$choice->id))<span class="error">{{$errors->first('status'.$choice->id)}}</span>@endif
        @empty
            <div>Aucune réponse définie</div>
        @endforelse
        <br>
        @if($score->status_question == 'fait')
            <div class="form-group text-center text-info">
                <div class="col-sm-offset-3 col-sm-6 well">
                    <h3 class="form-control-static">QCM Validé</h3>
                    <h4 class="back"><a href="{{url('admin/liste-qcm')}}"><i class="fa fa-hand-o-left" aria-hidden="true"></i>&nbsp; Retour liste des QCM</a></h4>
                </div>
            </div>
        @else
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-success btn-lg center-block">Valider &nbsp;<i class="fa fa-check-circle" aria-hidden="true"></i></button>
                </div>
            </div>
        @endif
    </form>
    </div>
@endsection