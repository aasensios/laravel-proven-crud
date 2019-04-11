<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id'); // Primary key por defecto
//            $table->ineger('id')->autoIncrement(); // Otra manera de hacerlo autoincremental
            $table->string('name')->unique();
            $table->string('description', 100)->nullable();
            $table->timestamps(); // Dos columnas extra por defecto
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
