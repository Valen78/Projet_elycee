@extends('layout.admin')

@section('title', $title)

@section('content')
    @if(Session::has('message'))
        <div class="alert alert-danger text-center"><h1>{{Session::get('message')}}</h1></div>
    @endif

    <div class="col-lg-10">
        <div class="text-center">
        <h2>Modification de l'article <em class="{{($post->status=='publish')?'green':'red'}}">{{$post->title}}</em></h2>

        <h4><a href="{{url('admin/posts')}}"><i class="fa fa-hand-o-left" aria-hidden="true"></i>&nbsp; Retour liste des articles</a></h4>
        </div>

        <form name="edit-post" id="edit-post" method="post" action="{{url('admin/posts',[$post->id])}}" class="form-horizontal" enctype="multipart/form-data">
            {{csrf_field()}}
            {{method_field('PUT')}}

            <input type="hidden" name="user_id" value="{{$userId}}">
            <input type="hidden" name="date" value="{{$date}}">

            <div class="form-group">
                <label for="picture" class="col-sm-3 control-label">Image (max 1Mo) : </label>
                <div class="col-sm-6">
                    @if(!empty($post->url_thumbnail))
                        <img src="{{url('uploads',$post->url_thumbnail)}}" class="img-responsive center-block">
                        <div class="form-group text-center">
                            <label for="deleteImg">
                                <h4 class="red"><input type="checkbox" name="deleteImg" id="deleteImg" value="deleteImg">  Supprimer l'image ?</h4>
                            </label>
                        </div>
                    @endif

                        <input type="file" name="picture" id="picture">
                </div>
            </div>

            <div class="form-group">
                <label for="title" class="col-sm-3 control-label">Titre<span class="red">*</span>  : </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="title" id="title" value="{{(empty($post->title))?'':$post->title}}">
                    @if($errors->has('title')) <span class="error">{{$errors->first('title')}}</span>@endif
                </div>
            </div>

            <div class="form-group">
                <label for="abstract" class="col-sm-3 control-label">Résumé : </label>
                <div class="col-sm-6">
                    <textarea name="abstract" id="abstract" class="form-control textarea-editor" rows="3">{{$post->abstract}}</textarea></p>
                    @if($errors->has('abstract')) <span class="error">{{$errors->first('abstract')}}</span>@endif
                </div>
            </div>

            <div class="form-group">
                <label for="content" class="col-sm-3 control-label">Contenu<span class="red">*</span>  : </label>
                <div class="col-sm-6">
                    <textarea name="content" id="content" class="form-control textarea-editor" rows="10">{{$post->content}}</textarea></p>
                    @if($errors->has('content')) <span class="error">{{$errors->first('content')}}</span>@endif
                </div>
            </div>

            <div class="form-group">
                <label for="status" class="col-sm-3 control-label">Status<span class="red">*</span>  : </label>
                <div class="col-sm-6">
                    <select name="status" id="status" class="form-control">
                        <option value="0">Choisissez un status</option>
                        <option value="unpublish" @if($post->status == 'unpublish') selected @endif>dépublié</option>
                        <option value="publish" @if($post->status == 'publish') selected @endif>publié</option>
                    </select>
                    @if($errors->has('status')) <span class="error">{{$errors->first('status')}}</span>@endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-success center-block">Mettre à jour &nbsp;<i class="fa fa-check-circle" aria-hidden="true"></i></button>
                </div>
            </div>
        </form>
        <p class="col-sm-offset-3 small red">* les champs avec un astérisque sont obligatoires.</p>
    </div>
@endsection
