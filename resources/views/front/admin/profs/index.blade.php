@extends('layout.admin')

@section('title', $title)

@section('content')
    <div class="col-lg-6 col-md-8">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                    <div class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse"  href="#qcm" aria-expanded="false">
                            <h3>Gestion des QCM <i class="fa fa-caret-square-o-down" aria-hidden="true"></i></h3>
                        </a>
                    </div>
                </div>
                <div id="qcm" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                        <div class="col-sm-offset-1">
                            <p class="lead">Les derniers QCM :</p>
                            <ul>
                                @forelse($questions as $question)
                                <li><h4>&bull; <a href="{{url('admin/fiches',[$question->id,'edit'])}}">{{$question->title}} &nbsp;<i class="fa fa-square {{($question->status == 'publish')?'green':'red'}}" aria-hidden="true"></i></a></h4></li>
                                @empty
                                    <li>Aucun qcm pour le moment</li>
                                @endforelse
                            </ul>
                            <h4><a href="{{url('admin/fiches')}}"><i class="fa fa-angle-double-right" aria-hidden="true"></i>&nbsp; Voir tous les QCM</a></h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingTwo">
                    <div class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse"  href="#articles" aria-expanded="false">
                            <h3>Gestion des articles <i class="fa fa-caret-square-o-down" aria-hidden="true"></i></h3>
                        </a>
                    </div>
                </div>
                <div id="articles" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                    <div class="panel-body">
                        <div class="col-sm-offset-1">
                        <p class="lead">Les derniers articles :</p>
                            <ul>
                                @forelse($posts as $post)
                                    <li><h4>&bull; <a href="{{url('admin/posts',[$post->id,'edit'])}}">{{$post->title}} &nbsp;<i class="fa fa-square {{($post->status == 'publish')?'green':'red'}}" aria-hidden="true"></i></a></h4></li>
                                @empty
                                    <li>Aucun article pour le moment</li>
                                @endforelse
                            </ul>
                            <h4><a href="{{url('admin/posts')}}"><i class="fa fa-angle-double-right" aria-hidden="true"></i>&nbsp; Voir tous les articles</a></h4>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingThree">
                    <div class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" href="#eleves" aria-expanded="false">
                            <h3>Gestion des élèves <i class="fa fa-caret-square-o-down" aria-hidden="true"></i></h3>
                        </a>
                    </div>
                </div>
                <div id="eleves" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                    <div class="panel-body">
                        <div class="col-sm-offset-1">
                            <h4><a href="{{url('admin/eleves')}}"><i class="fa fa-angle-double-right" aria-hidden="true"></i>&nbsp; Voir tous les élèves</a></h4>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="col-lg-4 col-lg-offset-1 col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab">
                <div class="panel-title">
                    <h3>Statistiques</h3>
                </div>
            </div>
            <div class="panel-body">
                <ul>
                    <li><h4><i class="fa fa-commenting-o green lead" aria-hidden="true"></i>&nbsp; <span class="badge">{{($comments<10)?'0'.$comments:$comments}}</span> commentaire(s)</h4></li>
                    <li><h4><i class="fa fa-list-alt bleu-tw lead" aria-hidden="true"></i>&nbsp; <span class="badge">{{($fiches<10)?'0'.$fiches:$fiches}}</span> fiche(s) publiée(s)</h4></li>
                    <li><h4><i class="fa fa-users bleu-fb lead" aria-hidden="true"></i>&nbsp; <span class="badge">{{($users<10)?'0'.$users:$users}}</span> élève(s)</h4></li>
                </ul>
            </div>
        </div>
    </div>
@endsection
