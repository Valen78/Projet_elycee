@include('partials.header')

@section('title', $title)

<div class="container">
    <h1 class="text-center text-uppercase well">Connexion à la partie privée</h1>

    <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        @if(Session::has('message'))
            <div class="alert alert-danger text-center text-uppercase"><h3>{{Session::get('message')}}</h3></div>
        @endif

        <form method="post" action="{{url('login')}}" class="login" id="login">
            {{csrf_field()}}
            <fieldset>
                <div class="form-group">
                    <label for="username">Identifiant <span class="red">*</span></label>
                    <input type="text" class="form-control" name="username" id="username" value="{{old('username')}}" placeholder="Votre Nom*" autofocus>
                    @if($errors->has('username'))<span class="error">{{$errors->first('username')}}</span>@endif
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe <span class="red">*</span></label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Votre mot de passe*">
                    <h6><u>Mot de passe oublié ?</u></h6>
                    @if($errors->has('password'))<span class="error">{{$errors->first('password')}}</span>@endif
                </div>
                <div class="checkbox col-md-5">
                    <label for="remember" class="control-label">
                        <input type="checkbox" name="remember" id="remember" value="remember" {{old('remember')?'checked':''}}>Se souvenir de moi
                    </label>
                </div>
                <div class="col-md-6 col-sm-offset-1">
                    <button type="submit" class="btn btn-orange btn-lg btn-block">Connexion &nbsp;<i class="fa fa-sign-in" aria-hidden="true"></i></button>
                </div>
            </fieldset>
            <p class="small red">* les champs avec un astérisque sont obligatoires.</p>
            <h4 class="col-xs-offset-1 back"><a href="{{url('/')}}"><i class="fa fa-hand-o-left" aria-hidden="true"></i>&nbsp; Retour sur le site</a></h4>
            <br>
        </form>
    </div>

</div>

@include('partials.footer')