@include('partials.header')

@include('partials.nav')

<div class="container-fluid">
        @yield('content')
</div>

<footer class="text-center">
    <a href="{{url('mentions-legales')}}" class="{{isActiveRoute('mentions')}}">Mentions légales</a> | <a href="{{url('contact')}}" class="{{isActiveRoute('contact')}}">Contact</a>
</footer>

@include('partials.footer')