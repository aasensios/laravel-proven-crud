<?php

use Illuminate\Database\Seeder;
use App\Movie;

class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Previous delete
        DB::table('movies')->delete();

        // Factory definition
        factory(Movie::class, 10)->create();
    }
}
