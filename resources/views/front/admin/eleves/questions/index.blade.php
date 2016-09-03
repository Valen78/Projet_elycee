@extends('layout.admin')

@section('title', $title)

@section('content')
    @if(Session::has('message'))
        <div class="alert alert-success text-center"><h1>{{Session::get('message')}}</h1></div>
    @endif
    <div class="col-lg-10">
        <h2>Liste des QCMs</h2>
        <br>

        <h4 class="text-center">Chaque question contient une ou plusieurs bonnes réponses, chaque bonne réponse rapporte 2 points.</h4>
        <hr class="hr">

    <div class="text-center">{{$fiches->links()}}</div>

    <table class="table table-hover table-responsive text-center">
        <thead>
        <tr>
            <th class="text-center border-right"><h3>Titre de la question</h3></th>
            <th class="text-center border-right"><h3>Statut</h3></th>
            <th class="text-center"><h3>Score</h3></th>
        </tr>
        </thead>
        <tbody>
        @forelse($fiches as $fiche)
            <tr class="lead">
                @foreach($fiche->scores as $score)
                    @if($score->user_id == Auth::user()->id)
                        <td class="border-right">
                            {!!$score->status_question == 'fait' ? $fiche->title : '<a href="'.url('admin/qcm', $fiche->id).'">'.$fiche->title.'</a>'!!}
                        </td>
                        <td class="border-right {{$score->status_question == 'fait' ? 'green' : 'red'}}">{{$score->status_question == 'fait' ? 'fait' : 'pas fait'}} &nbsp;<i class="fa fa-square"></i></td>
                        <td>{{$score->note}} / {{$total_note[$score->question_id]}}</td>
                    @endif
                @endforeach
            </tr>
        @empty
            <tr>
                <td colspan="3">Pas de questionnaire disponible</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <div class="text-center">{{$fiches->links()}}</div>
@endsection