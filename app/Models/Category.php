<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'description', 
    ];
    
//    // Forzar el nombre de la table en la migracion
//    protected $table = 'miscategorias';
//    
//    // Forzar que la primary key sea otro campo
//    protected $primary_key = 'name';

    public function listProducts() {
        return $this->hasMany(Product::class);
    }

    // For more relations, see laravel eloquent version 5.6, Many to Many (belongsToMany), One to One, One to Many, etc.
    
}
