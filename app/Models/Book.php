<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['cateogry_id','name', 'image', 'author_name', 'published_date'];

    public function category()
    {
        return $this->belongsTo(Cateogry::class, 'cateogry_id', 'id');
    }

}
