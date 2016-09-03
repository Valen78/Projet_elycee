<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="nav navbar-nav">
            <ul class="social">
                <li><button class="btn btn-like"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> j'aime</button></li>
                <li><a class="bleu-fb"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>
                <li><a class="bleu-tw"><i class="fa fa-twitter-square" aria-hidden="true"></i></a></li>
            </ul>
        </div>
        <ul class="nav navbar-nav navbar-right menu-top">
            @if(Auth::guest())
                <li><a href="{{url('login')}}"><h4><i class="fa fa-user" aria-hidden="true"></i> &nbsp; Connectez-vous</h4></a></li>
            @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><h4><i class="fa fa-user" aria-hidden="true"></i>&nbsp; Bonjour {{Auth::user()->username}} <span class="caret"></span></h4></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('admin')}}">Dashboard</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{url('logout')}}">Déconnexion &nbsp;<i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
                    </ul>
                </li>
            @endif
        </ul>
    </div>

    <div class="container-fluid bg-dark-grey">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{url('/')}}"><img src="{{url('imgs','logo-lycee.png')}}" class="img-responsive center-block"></a>
        </div>

        <div class="collapse navbar-collapse" id="menu">
                <ul class="nav navbar-nav">
                    <li class="{{isActiveRoute('home')}}"><a href="{{url('/')}}">Home</a></li>
                    <li class="{{isActiveRoute('articles')}}"><a href="{{url('articles')}}">Actus</a></li>
                    <li class="{{isActiveRoute('le-lycee')}}"><a href="{{url('le-lycee')}}">Le Lycée</a></li>
                </ul>

            <div class="nav navbar-nav navbar-right">
                <form class="navbar-form navbar-left" role="search" id="search" name="search" action="{{url('search')}}" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <div class="input-group">
                        <input type="text" class="form-control" name="search-content" id="search-content" placeholder="Rechercher" value="{{(isset($search)?$search:'')}}">
                            <div class="input-group-addon"><button type="submit" class="btn btn-search"><i class="fa fa-search" aria-hidden="true"></i></button></div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</nav>