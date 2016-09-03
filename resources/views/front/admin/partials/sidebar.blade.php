<div class="col-lg-2 col-lg-offset-1 col-md-3 col-sm-4 sidebar-admin">
    <ul class="text-capitalize">
        <li class="{{isActiveRoute('dashboard')}}"><a href="{{url('admin')}}"><i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp; dashboard</a></li>
    @if (Auth::user()->role == 'teacher')
        <li class="{{areActiveRoutes(['admin.fiches.index', 'admin.fiches.create', 'admin.fiches.edit', 'admin.fiches.choices.create', 'admin.fiches.choices.edit'])}}"><a href="{{url('admin/fiches')}}"><i class="fa fa-list-alt" aria-hidden="true"></i>&nbsp; Fiches</a></li>
        <li class="{{areActiveRoutes(['admin.posts.index', 'admin.posts.create', 'admin.posts.edit'])}}"><a href="{{url('admin/posts')}}"><i class="fa fa-newspaper-o" aria-hidden="true"></i>&nbsp; Articles</a></li>
        <li class="{{isActiveRoute('eleves')}}"><a href="{{url('admin/eleves')}}"><i class="fa fa-users" aria-hidden="true"></i>&nbsp; élèves</a></li>
    @else
        <li class="{{isActiveRoute('qcm')}}"><a href="{{url('admin/liste-qcm')}}"><i class="fa fa-list-alt" aria-hidden="true"></i>&nbsp; QCM</a></li>
    @endif
    </ul>
</div>