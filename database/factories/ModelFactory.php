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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Users\Models\User::class, function (Faker\Generator $faker) {
    static $password;
    $name = $faker->name;
    return [
        'slug' => str_slug($name),
        'name' => $name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Forums\Models\Forum::class, function (Faker\Generator $faker) {
    $name = $faker->word;
    return [
    	'slug' => str_slug($name),
        'name' => $name,
        'description' => $faker->sentence,
    ];
});

$factory->define(App\Forums\Models\Topic::class, function (Faker\Generator $faker) {
    $name = $faker->word;
    return [
        'user_id' => factory(App\Users\Models\User::class)->create()->id,
        'forum_id' => factory(App\Forums\Models\Forum::class)->create()->id,
        'slug' => str_slug($name),
        'name' => $name,
        'body' => $faker->sentence,
    ];
});

$factory->define(App\Forums\Models\Reply::class, function (Faker\Generator $faker) {
    $name = $faker->word;
    return [
        'user_id' => factory(App\Users\Models\User::class)->create()->id,
        'topic_id' => factory(App\Forums\Models\Topic::class)->create()->id,
        'body' => $faker->sentence,
    ];
});
