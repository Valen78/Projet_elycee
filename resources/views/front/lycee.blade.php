@extends('layout.master')

@section('title', $title)

@section('content')
    <div class="text-center well">
        <h1>&Agrave; la découverte de notre Lycée</h1>
    </div>

    <div class="media">
        <div class="col-sm-5 col-md-12 col-lg-5">
            <img class="img-responsive center-block img-rounded" src="{{url('imgs','lycee-facade.jpg')}}" alt="le lycée">
        </div>
        <div class="col-sm-7 col-md-12 col-lg-7">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur at blanditiis consequuntur dolorum esse facere facilis in, iure iusto necessitatibus nisi non perspiciatis placeat quam quia quod rerum, tempora, veniam. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem cumque deserunt dolorem excepturi hic, impedit magni minus neque pariatur perferendis recusandae repudiandae, rerum sit tenetur unde ut, vel velit veniam? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis eligendi expedita hic id ipsum, itaque laborum minima nemo provident quisquam recusandae repellendus saepe sit soluta tempora tempore voluptatem!</p>
        </div>
    </div>

    <div class="media">
        <div class="col-sm-5 col-sm-push-7 col-md-12 col-md-push-0 col-lg-5 col-lg-push-7">
            <img class="img-responsive center-block img-rounded" src="{{url('imgs','salle-de-classe.jpg')}}" alt="le lycée">
        </div>
        <div class="col-sm-7 col-sm-pull-5 col-md-12 col-md-pull-0 col-lg-7 col-lg-pull-5">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi doloribus facilis iure necessitatibus obcaecati quisquam ullam. Eligendi enim exercitationem inventore ipsam, iure maiores maxime molestias odio officia rerum similique, soluta? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores at aut autem doloremque exercitationem incidunt inventore libero, neque praesentium quos repudiandae tenetur vitae. Cum exercitationem expedita perferendis veniam vitae voluptate? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab amet asperiores blanditiis, corporis delectus deleniti eum illum iusto laboriosam molestiae nesciunt nulla odit possimus provident, quisquam ratione voluptates? Asperiores, nemo?</p>
        </div>
    </div>
@endsection