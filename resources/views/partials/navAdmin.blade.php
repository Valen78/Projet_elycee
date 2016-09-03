<nav class="navbar navbar-default">
    <div class="container nav-admin">
        <div class="nav navbar-nav">
            <a href="{{url('/')}}" class="text-right"><h4>Retour au site public <i class="fa fa-level-up" aria-hidden="true"></i></h4></a>
        </div>
        <div class="nav navbar-nav navbar-right menu-top">
            <h4><i class="fa fa-user" aria-hidden="true"></i> &nbsp; Bonjour {{Auth::user()->username}}</h4>
            <a href="{{url('logout')}}" class="text-right"><h5>Déconnexion &nbsp;<i class="fa fa-sign-out" aria-hidden="true"></i></h5></a>
        </div>
    </div>
</nav>