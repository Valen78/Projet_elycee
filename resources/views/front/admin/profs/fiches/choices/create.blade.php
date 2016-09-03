@extends('layout.admin')

@section('title', $title)

@section('content')
    <div class="col-lg-10">
        <div class="text-center">
            <h2>Ajout d'un QCM - &Eacute;tape 2/2</h2>
            <h4><a href="{{url('admin/fiches')}}"><i class="fa fa-hand-o-left" aria-hidden="true"></i>&nbsp; Retour liste des QCM</a></h4>
        </div>
    </div>
    <div class="clearfix"></div>
    <form name="ajout-reponse" id="ajout-reponse" action="{{url('admin/fiches/choices')}}" method="post" class="col-md-offset-2">
        {{csrf_field()}}

        <input type="hidden" value="{{count(session('datas')['choices'])}}" name="nb_choices">
        <input type="hidden" value="{{session('datas')['question_id']}}" name="question_id">

        <div class="row">
            <div class="col-lg-8 col-md-9">
                @foreach(session('datas')['choices'] as $i => $choice)
                    <div class="form-group">
                        <label for="content{{$choice->id}}" class="control-label">Réponse {{$i+1}}</label>
                        <textarea name="content{{$choice->id}}" id="content{{$choice->id}}" class="form-control textarea-editor">{{old('content'.$choice->id)}}</textarea>
                        @if($errors->has('content'.$choice->id))<span class="error">{{$errors->first('content'.$choice->id)}}</span>@endif
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-4 col-sm-offset-3 col-xs-offset-6 text-center">
                            <label class="radio-inline">
                                <input type="radio" name="status{{$choice->id}}" id="yes" value="yes" class="" {{old('status'.$choice->id) == 'yes' ? 'checked':''}}> oui
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="status{{$choice->id}}" id="no" value="no" class="" {{old('status'.$choice->id) == 'no' ? 'checked':''}}> non
                            </label>
                            <br>
                            @if($errors->has('status'.$choice->id))<span class="error">{{$errors->first('status'.$choice->id)}}</span>@endif
                        </div>
                    </div>
                @endforeach
                <div class="modal-footer">
                    <a href="{{url('admin/fiches',[session('datas')['question_id'],'edit'])}}" class="btn btn-warning"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i>&nbsp; &Eacute;tape 1/2</a>
                    <button type="submit" class="btn btn-success">Valider &nbsp;<i class="fa fa-check-circle" aria-hidden="true"></i></button>
                </div>
            </div>
        </div>
    </form>
    <p class="col-md-offset-2 small red">Tous les champs sont obligatoires.</p>
@endsection