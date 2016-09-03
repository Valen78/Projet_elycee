@extends('layout.admin')

@section('title', $title)

@section('content')
    @if(Session::has('message'))
        <div class="alert alert-success text-center"><h1>{{Session::get('message')}}</h1></div>
    @endif

    @if(Session::has('alert'))
        <div class="alert alert-danger text-center"><h1>{{Session::get('alert')}}</h1></div>
    @endif

    <div class="col-lg-10">
        <h2>Liste des fiches &nbsp;<a href="{{url('admin/fiches/create')}}" class="btn btn-orange btn-lg">Ajouter &nbsp;<i class="fa fa-plus-circle" aria-hidden="true"></i></a></h2>

            <form name="action" id="action" action="" method="post" class="form-inline">
                {{csrf_field()}}
                <select name="status" id="status" class="form-control text-capitalize">
                    <option value="0">actions groupées</option>
                    <option value="publish">publié</option>
                    <option value="unpublish">dépublié</option>
                    <option value="delete">supprimer</option>
                </select>
                <button type="submit" id="do-action" class="btn btn-danger">Appliquer</button>
            </form>

        <table class="table table-hover table-responsive text-center tableData" id="fiches">
            <thead>
            <tr>
                <th class="text-center"><h3><input type="checkbox" name="checkAll" id="checkAll"></h3></th>
                <th class="text-center"><h3>Titre</h3></th>
                <th class="text-center"><h3>Classe</h3></th>
                <th class="text-center"><h3>Statut</h3></th>
                <th class="text-center"><h3>Réponse(s)</h3></th>
            </tr>
            </thead>
            <tbody>
            @forelse($fiches as $fiche)
                <tr class="all">
                    <td class="text-center"><input type="checkbox" name="checkId" class="checkId" value="{{$fiche->id}}"></td>
                    <td class="lead"><a href="{{url('admin/fiches',[$fiche->id,'edit'])}}">{{$fiche->title}}</a></td>
                    <td class="lead">{{$fiche->class_level}}</td>
                    <td class="{{($fiche->status=='publish')?'green':'red'}} lead"><strong>{{($fiche->status=='publish')?'publié':'dépublié'}}</strong></td>
                    <td class="lead">{{count($fiche->choices)}}</td>
                </tr>
            @empty
                <tr><td colspan="5">Aucun QCM existant !</td></tr>
            @endforelse
            </tbody>
        </table>

    </div>

    <!-- Modal Suppression -->
    <div class="modal" id="delete" tabindex="-1" role="dialog" aria-labelledby="deleteLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="well">
                        <h3>Etes vous sur de vouloir supprimer cette (ou ces) fiche(s) ?</h3>
                    </div>
                </div>
                <div class="modal-footer">
                    <form method="post" action="">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <button type="submit" class="btn btn-success">OUI &nbsp;<i class="fa fa-check" aria-hidden="true"></i></button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">NON &nbsp;<i class="fa fa-times" aria-hidden="true"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
