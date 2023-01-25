<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 10; $i++) {
            $newProject = new Project();
            $newProject->cover_image = 'placeholders/' . $faker->image('storage/app/public/placeholders', 400, 200, 'Project', false, false);
            $newProject->title = $faker->sentence(3);
            $newProject->slug = Str::slug($newProject->title, '-');
            $newProject->body = $faker->text(300);
            $newProject->save();
        }
    }
}
