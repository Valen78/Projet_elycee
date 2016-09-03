@extends('layout.admin')

@section('title', $title)

@section('content')
    <div class="col-lg-6 col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab">
                <div class="panel-title">
                    <h3>Statistiques</h3>
                </div>
            </div>
            <div class="panel-body">
                <ul>
                    <li><h4><i class="fa fa-star-half-o yellow lead" aria-hidden="true"></i>&nbsp; <span class="badge">{{($note<10)?'0'.$note:$note}}</span> sur {{$total_score}} points possibles</h4></li>
                    <li><h4><i class="fa fa-list-alt bleu-tw lead" aria-hidden="true"></i>&nbsp; <span class="badge">{{($qcm_fait<10)?'0'.$qcm_fait:$qcm_fait}}</span> QCM réalisé(s) sur un total de {{$total_qcm}}</h4></li>
                </ul>
            </div>
        </div>
    </div>
@endsection
