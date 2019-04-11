<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Previous deletion of categories table in database
        // sDB::table('categories')->truncate();

        // Generate a random sample register in database
        // DB::table('categories')->insert([
        //     // 'id' => rand(0, 9),
        //     'name' => Str::random(10), // str_random(10),
        //     'description' => str_random(50),
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);

        // Previous delete
        DB::table('categories')->delete();

        // Factory replaces the previuos manual random generation
        factory(Category::class, 5)->create();
    }
}
