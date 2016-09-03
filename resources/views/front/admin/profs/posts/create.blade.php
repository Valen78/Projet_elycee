@extends('layout.admin')

@section('title', $title)

@section('content')
    @if(Session::has('message'))
        <div class="alert alert-danger text-center"><h1>{{Session::get('message')}}</h1></div>
    @endif

    <div class="col-lg-10">
        <div class="text-center">
            <h2>Ajout d'un article</h2>
            <h4><a href="{{url('admin/posts')}}"><i class="fa fa-hand-o-left" aria-hidden="true"></i>&nbsp; Retour liste des articles</a></h4>
        </div>

        <form name="ajout-post" id="ajout-post" method="post" action="{{url('admin/posts')}}" class="form-horizontal" enctype="multipart/form-data">
            {{csrf_field()}}

            <input type="hidden" name="user_id" value="{{$userId}}">
            <input type="hidden" name="date" value="{{$date}}">

            <div class="form-group">
                <label for="picture" class="col-sm-3 control-label">Image (max 1Mo) : </label>
                <div class="col-sm-6">
                    <input type="file" name="picture" id="picture">
                </div>
            </div>

            <div class="form-group">
                <label for="title" class="col-sm-3 control-label">Titre<span class="red">*</span> : </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="title" id="title" value="{{old('title')}}">
                    @if($errors->has('title')) <span class="error">{{$errors->first('title')}}</span>@endif
                </div>
            </div>

            <div class="form-group">
                <label for="abstract" class="col-sm-3 control-label">Résumé : </label>
                <div class="col-sm-6">
                    <textarea name="abstract" id="abstract" class="form-control textarea-editor" rows="3">{{old('abstract')}}</textarea></p>
                    @if($errors->has('abstract')) <span class="error">{{$errors->first('abstract')}}</span>@endif
                </div>
            </div>

            <div class="form-group">
                <label for="content" class="col-sm-3 control-label">Contenu<span class="red">*</span> : </label>
                <div class="col-sm-6">
                    <textarea name="content" id="content" class="form-control textarea-editor" rows="10">{{old('content')}}</textarea></p>
                    @if($errors->has('content')) <span class="error">{{$errors->first('content')}}</span>@endif
                </div>
            </div>

            <div class="form-group">
                <label for="status" class="col-sm-3 control-label">Status<span class="red">*</span> : </label>
                <div class="col-sm-6">
                    <select name="status" id="status" class="form-control">
                        <option value="0">Choisissez un status</option>
                        <option value="unpublish">unpublish</option>
                        <option value="publish">publish</option>
                    </select>
                    @if($errors->has('status')) <span class="error">{{$errors->first('status')}}</span>@endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-success center-block">Ajouter &nbsp;<i class="fa fa-check-circle" aria-hidden="true"></i></button>
                </div>
            </div>
        </form>
        <p class="col-sm-offset-3 small red">* les champs avec un astérisque sont obligatoires.</p>
    </div>
@endsection
