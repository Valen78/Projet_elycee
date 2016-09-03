@extends('layout.admin')

@section('title', $title)

@section('content')
    <div class="col-lg-10">
        <div class="text-center">
            <h2>Ajout d'un QCM - &Eacute;tape 1/2</h2>
            <h4><a href="{{url('admin/fiches')}}"><i class="fa fa-hand-o-left" aria-hidden="true"></i>&nbsp; Retour liste des QCM</a></h4>
        </div>
    </div>

    <div class="clearfix"></div>

    <form name="ajout-question" id="ajout-question" action="{{url('admin/fiches')}}" method="post" class="col-md-offset-2">
        {{csrf_field()}}
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="class_level" class="control-label">Niveau</label>
                    <select name="class_level" id="class_level" class="form-control">
                        <option value="0">Choisissez un niveau</option>
                        <option value="terminale" {{old('class_level') == 'terminale' ? 'selected' : ''}}>Terminale S</option>
                        <option value="premiere" {{old('class_level') == 'premiere' ? 'selected' : ''}}>Première S</option>
                    </select>
                    @if($errors->has('class_level'))<span class="error">{{$errors->first('class_level')}}</span>@endif
                </div>
            </div>

            <div class="col-md-3 col-md-offset-2 col-lg-offset-1">
                <div class="form-group">
                    <label for="nb_choices" class="control-label">Nombre de choix</label>
                    <input type="number" class="form-control" name="nb_choices" min="1" value="{{!is_null(old('nb_choices')) ? old('nb_choices') : 1}}">
                    @if($errors->has('nb_choices'))<span class="error">{{$errors->first('nb_choices')}}</span>@endif
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="col-lg-8 col-md-9">
                <div class="form-group">
                    <label for="title" class="control-label">Titre</label>
                    <input type="text" name="title" class="form-control" value="{{old('title')}}">
                    @if($errors->has('title'))<span class="error">{{$errors->first('title')}}</span>@endif
                </div>

                <div class="form-group">
                    <label for="content" class="control-label">Rédaction de la question</label>
                    <textarea name="content" id="content" class="form-control textarea-editor" rows="5" col="20">{{old('content')}}</textarea>
                    @if($errors->has('content'))<span class="error">{{$errors->first('content')}}</span>@endif
                </div>
                <button type="submit" class="btn btn-success center-block">&Eacute;tape 2 &nbsp;<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
            </div>
        </div>
    </form>
    <p class="col-md-offset-2 small red">Tous les champs sont obligatoires.</p>
@endsection