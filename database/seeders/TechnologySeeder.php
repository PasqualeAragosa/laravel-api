<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Inizializzo un array di tecnologie
        $technologies = ['Laravel', 'PHP', 'MySQL', 'VueJs', 'JavaScript', 'Vite', 'HTML', 'CSS', 'SASS', 'Bootstrap', 'NodeJs'];

        // Creo un'istanza dell'oggetto Technology tramite gli elementi dell'array
        foreach ($technologies as $technology) {
            $newTechnology = new Technology();
            $newTechnology->name = $technology;
            $newTechnology->slug = Str::slug($technology);
            $newTechnology->save();
        }
    }
}
