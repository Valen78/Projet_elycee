<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<img src="{{url('imgs','logo-lycee.png')}}" height="100">
<h3>Vous avez reçu une demande de contact de {{$email}}</h3>
<h3><u>Objet</u> : <em>{{$subject}}</em></h3>
<h4><u>Son commentaire</u> : <br>
    {!! nl2br($content) !!}</h4>
</body>
</html>