<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    // Primary Id
    protected $primaryKey = 'category_id';

    // Guarded
    protected $guarded = ['category_id'];

    public function posts()
    {
        return $this->hasMany(Posts::class,'category_id','category_id');
    }
}
