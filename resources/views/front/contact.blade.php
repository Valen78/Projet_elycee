@extends('layout.master')

@section('title', $title)

@section('content')

    @if(Session::has('message'))
        <div class="alert alert-success text-center"><h1>{{Session::get('message')}}</h1></div>
    @endif
    <div class="text-center well">
        <h2>Contactez-nous</h2>
    </div>

    <div class="col-sm-6 col-sm-offset-3">
        <form action="{{url('mail-contact')}}" method="post" class="contact" id="contact">
            {{csrf_field()}}

            <div class="form-group">
                <label for="email" class="control-label">E-mail <span class="red">*</span></label>
                <input type="email" name="email" id="email" class="form-control" value="{{old('email')}}" placeholder="Votre E-mail*">
                @if($errors->has('email'))<span class="label label-danger">{{$errors->first('email')}}</span>@endif
            </div>

            <div class="form-group">
                <label for="subject" class="control-label">Objet <span class="red">*</span></label>
                <input type="text" name="subject" id="subject" class="form-control" value="{{old('subject')}}" placeholder="Objet*">
                @if($errors->has('subject'))<span class="label label-danger">{{$errors->first('subject')}}</span>@endif
            </div>

            <div class="form-group">
                <label for="content" class="control-label">Commentaires <span class="red">*</span></label>
                <textarea name="content" id="content" class="form-control" cols="30" rows="5" placeholder="Vos commentaires*"></textarea>
                @if($errors->has('content'))<span class="label label-danger">{{$errors->first('content')}}</span>@endif
            </div>

            <button type="submit" name="submit" id="submit" class="btn btn-orange center-block">Envoyer &nbsp;<i class="fa fa-send-o" aria-hidden="true"></i></button>
        </form>
        <p class="small red">* les champs avec un astérisque sont obligatoires.</p>
    </div>

    <div class="clearfix"></div>

    <div id="map"></div>
    <input type="hidden" id="lat" value="{{$lat}}">
    <input type="hidden" id="lng" value="{{$lng}}">
    <h4 class="text-center">{{isset($address)?$address:''}}</h4>
@endsection