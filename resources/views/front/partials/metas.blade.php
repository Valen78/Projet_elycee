<div class="clearfix"></div>
<div class="metas">
@if(!is_null($post->user))
    <small><strong>Auteur : </strong> <em>{{$post->user->username}} &nbsp; - &nbsp; </em></small>
@else
    <strong>Aucun Auteur &nbsp; - &nbsp; </strong>
@endif

@if(!is_null($post->date))
    <small><strong>Publié le : </strong> <em>{{$post->date->format('d/m/Y')}}</em></small>
@endif

    <br>

@if(count($post->comments) > 0)
    <small><i class="fa fa-commenting-o" aria-hidden="true"></i>&nbsp; {{count($post->comments)}} commentaire(s)</small>
@else
    <small>Aucun commentaires</small>
@endif
</div>