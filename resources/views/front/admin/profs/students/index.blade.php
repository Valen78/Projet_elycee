@extends('layout.admin')

@section('title', $title)

@section('content')

    <div class="col-lg-10">
        <h2>Liste des élèves</h2>

        <div class="text-center">{{$users->links()}}</div>

        <table class="table table-bordered table-hover table-responsive text-center" id="users">
            <thead>
            <tr>
                <th class="text-center"><h3>Nom</h3></th>
                <th class="text-center"><h3>Rôle</h3></th>
            </tr>
            </thead>
            <tbody>
            @forelse($users as $user)
                <tr>
                    <td class="text-capitalize">{{$user->username}}</td>
                    <td>{{($user->role=='first_class')?'première':'terminale'}}</td>
                </tr>
            @empty
                <tr><td colspan="2">Aucun élèves existant !</td></tr>
            @endforelse
            </tbody>
        </table>

        <div class="text-center">{{$users->links()}}</div>
    </div>
@endsection
