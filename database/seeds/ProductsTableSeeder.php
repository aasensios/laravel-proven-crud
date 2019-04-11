<?php

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Previous delete
        DB::table('products')->delete();

        // Factory definition
        factory(Product::class, 10)->create();
    }
}
