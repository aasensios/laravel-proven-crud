<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'price',
        'description',
        'category_id',
    ];

    // protected $hidden = [
    //     'category',
    // ];

    public function Category() {
        return $this->belongsTo(Category::class);
    }
}
