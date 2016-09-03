@extends('layout.admin')

@section('title', $title)

@section('content')
    <div class="col-lg-10">
        <div class="text-center">
            <h2>Modification de la fiche <em class="{{($fiche->status=='publish')?'green':'red'}}">{{$fiche->title}}</em> - &Eacute;tape 1/2</h2>
            <h4><a href="{{url('admin/fiches')}}"><i class="fa fa-hand-o-left" aria-hidden="true"></i>&nbsp; Retour liste des QCM</a></h4>
        </div>
    </div>

    <div class="clearfix"></div>

    <form action="{{url('admin/fiches', $fiche->id)}}" method="post" class="col-md-offset-2">
        {{csrf_field()}}
        {{method_field('PUT')}}

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="class_level" class="control-label">Niveau</label>
                    <select name="class_level" id="class_level" class="form-control" {{($fiche->status == 'publish') || ($fiche->status == 'unpublish' && $fait == true)?'disabled':''}}>
                        <option value="terminale"
                                @if(!is_null(old('class_level')))
                                {{old('class_level') == 'terminale' ? 'selected' : ''}}
                                @elseif($fiche->class_level == 'terminale')
                                selected
                                @endif
                        >Terminale S</option>
                        <option value="premiere"
                                @if(!is_null(old('class_level')))
                                {{old('class_level') == 'premiere' ? 'selected' : ''}}
                                @elseif($fiche->class_level == 'premiere')
                                selected
                                @endif
                        >Première S</option>
                    </select>
                    @if($errors->has('class_level'))<span class="error">{{$errors->first('class_level')}}</span>@endif
                </div>
            </div>

            <div class="col-md-3 col-md-offset-2 col-lg-offset-1">
                <div class="form-group">
                    <label for="nb_choices" class="control-label">Nombre de choix</label>
                    <input type="number" class="form-control" name="nb_choices" id="nb_choices" min="1" value="{{count($fiche->choices)}}" disabled>
                    @if($errors->has('nb_choices'))<span class="error">{{$errors->first('nb_choices')}}</span>@endif
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="col-lg-8 col-md-9">
                <div class="form-group">
                    <label for="title" class="control-label">Titre</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{!is_null(old('title')) ? old('title') : $fiche->title}}">
                    @if($errors->has('title'))<span class="error">{{$errors->first('title')}}</span>@endif
                </div>

                <div class="form-group">
                    <label for="content" class="control-label">Rédaction de la question</label>
                    <textarea name="content" id="content" class="form-control textarea-editor" rows="5">{{!is_null(old('content')) ? old('content') : $fiche->content}}</textarea>
                    @if($errors->has('content'))<span class="error">{{$errors->first('content')}}</span>@endif
                </div>

                <button type="submit" class="btn btn-success center-block">&Eacute;tape 2 &nbsp;<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
            </div>
        </div>
    </form>
    <p class="col-md-offset-2 small red">Tous les champs sont obligatoires.</p>
@endsection