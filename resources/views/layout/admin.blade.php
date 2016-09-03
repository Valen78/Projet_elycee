@include('partials.header')

@include('partials.navAdmin')

    <div class="container-fluid">
        @section('sidebar')
            @include('front.admin.partials.sidebar')
        @show
        <div class="col-md-9 col-sm-8">
            @yield('content')
        </div>
    </div>

@include('partials.footer')