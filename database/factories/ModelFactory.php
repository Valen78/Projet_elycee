<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Post::class, function (Faker\Generator $faker) {
    $dirUpload = public_path(env('UPLOAD_PICTURES','uploads'));

    $uri = str_random(50). '_400x250.jpg';

    $id = rand(1,9);

    $fileName = file_get_contents("http://loremflickr.com/400/250/$id");

    File::put($dirUpload.DIRECTORY_SEPARATOR.$uri, $fileName);

    return [
        'user_id' => 1,
        'title' => $faker->title,
        'abstract' => $faker->paragraph(3),
        'content' => $faker->paragraph(30),
        'url_thumbnail' => $uri,
        'date' => $faker->dateTime('now'),
        'status' => (rand(1,5)==1)?'publish':'unpublish'
    ];
});
