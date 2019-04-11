<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id'); // by default
            $table->string('name', 50)->unique();
            $table->float('price', 8, 2)->default(0);
            $table->text('description', 100)->nullable();
            $table->integer('category_id')->unsigned()->nullable();
            $table->timestamps(); // two extra rows by default: created_at and modified_at
            // Foreign key
            $table->foreign('category_id')->references('id')->on('categories')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
