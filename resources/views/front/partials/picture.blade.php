@if(!empty($post->url_thumbnail))
    <img src="{{url('uploads',$post->url_thumbnail)}}" alt="{{$post->title}}" class="img-responsive center-block img-rounded">
@else
    <img src="{{url('imgs','no-image.png')}}" alt="{{$post->title}}" class="img-responsive center-block img-rounded">
@endif