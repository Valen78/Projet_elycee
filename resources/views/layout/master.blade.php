@include('partials.header')

@include('partials.nav')

    <div class="container-fluid">
        <div class="col-md-7 col-md-offset-1">
            @yield('content')
        </div>

        @section('sidebar')
            @include('front.partials.sidebar')
        @show
    </div>

    <footer class="text-center">
        <a href="{{url('mentions-legales')}}" class="{{isActiveRoute('mentions')}}">Mentions légales</a> | <a href="{{url('contact')}}" class="{{isActiveRoute('contact')}}">Contact</a>
    </footer>

@include('partials.footer')